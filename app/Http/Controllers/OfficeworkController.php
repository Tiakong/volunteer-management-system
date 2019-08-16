<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\AdminAccount;
use App\VolunteerAccount;
use App\Volunteer;
use App\Event;
use App\Programme;
use App\ProgrammeImage;
use App\InterestedProgramme;
use App\Officework;
use App\Notification;
use App\AwardHistory;
use App\Skillset;
use App\VolunteerEvent;
use App\VolunteerNotification;
use App\VolunteerOfficework;

class OfficeworkController extends Controller
{	
	public function index()
	{
		$pp = 20;
		$officeworks = Officework::orderby('created_at', 'desc')->paginate($pp);

		return view('officework.index', ['officeworks' => $officeworks, 'per_page'=>$pp]);
		
	}
	
    public function create()
    {
		return view('officework.create');
    }
	
	public function store(Request $request)
    {
		//Check required field
		$this->validate($request, [
			'description' 	=> 'required|max:1000',
			'created_by'	=> 'required|max:100',
			'serve_hour'	=> 'required|regex:/^\d+(\.\d{1,2})?$/'
		]);
		
		//Get list of volunteer assigned to this office work
		$volunteerList = json_decode($request->get('volunteerList'));
		var_dump($volunteerList);
		
		//No volunteer assigned
		if(!$volunteerList)
		{
			return redirect()
			->route('officework.create')
			->with('fail','Must assign at least 1 volunteer.');
		}
		
		//========End of validation========
		
		//Store officework
		$officework = new Officework([
			'description'	=>  $request->get('description'),
			'serve_hour' 	=>	(float)$request->get('serve_hour'),
			'created_by'	=>  $request->get('created_by'),
		]);
		$officework -> save();
		
		//Store volunteer_officework
		foreach($volunteerList as $index => $volunteer)
		{
			$vo = new VolunteerOfficework([
				'vid'		=> $volunteer->vid,
				'oid'		=> $officework->oid,
				'remark'	=> $volunteer->remark,
				'serve_hour'=> $officework->serve_hour
			]);
			$vo->save();
		}
		
		return redirect()
		->route('officework.create')
		->with('success', 'Administrative work recorded successfully.');
	}
	
	 public function show($id)
    {
		$officework = Officework::findOrFail($id);
		
		$volunteersId = DB::table('volunteer_officeworks as vo')
		->where('oid',$id)
		->pluck('vid');
		
		$volunteers = DB::table('volunteer_officeworks as vo')
		->where('oid',$id)
		->join('volunteers as v', 'v.vid', '=', 'vo.vid')
		->whereIn('vo.vid', $volunteersId)
		->select('v.vid','v.id','v.name','vo.remark','vo.serve_hour')
		->orderby('v.name')
		->get();
		return view('officework.show', ['officework' => $officework, 'volunteers' => $volunteers]);
    }
	
	 public function edit($id)
    {
		$officework = Officework::findOrFail($id);
		
		$volunteersId = DB::table('volunteer_officeworks as vo')->where('oid',$id)->pluck('vo.vid');
		
		$volunteers = DB::table('volunteer_officeworks as vo')
		->where('oid',$id)
		->join('volunteers as v', 'v.vid', '=', 'vo.vid')
		->whereIn('vo.vid', $volunteersId)
		->select('v.vid','v.id','v.name','vo.remark','vo.serve_hour')
		->orderby('v.name', 'asec')
		->get();
		return view('officework.edit', ['officework' => $officework, 'volunteers' => $volunteers]);
    }
	
	//Must present if edit is present
    public function update(Request $request, $id)
    {
		//Check required field
		$this->validate($request, [
			'description' 	=> 'required|max:1000',
			'serve_hour'	=> 'required|regex:/^\d+(\.\d{1,2})?$/'
		]);
		
		//Get list of volunteer assigned to this office work
		$volunteerList = json_decode($request->get('volunteerList'));
		var_dump($volunteerList);
		
		//No volunteer assigned
		if(!$volunteerList)
		{
			return redirect()
			->route('officework.create')
			->with('fail','Must assign at least 1 volunteer.');
		}
		
		
		//========End of validation========
		
		//Update office work
		$officework = Officework::findOrFail($id);
		$officework->description	= $request->get('description');
		$officework->serve_hour		= $request->get('serve_hour');
		$officework -> save();
		
		//Delete and re-assign volunteer_officework
		$vos = VolunteerOfficework::where('oid', $officework->oid)->delete();
		
		foreach($volunteerList as $index => $volunteer)
		{
			$vo = new VolunteerOfficework([
				'vid'		=> $volunteer->vid,
				'oid'		=> $officework->oid,
				'remark'	=> $volunteer->remark,
				'serve_hour'=> $officework->serve_hour
			]);
			$vo->save();
		}
		
		return redirect()->route('officework.show', $id)->with('success', 'Administrative work updated successfully.');
    }
	
    public function destroy($id)
    {
		$officework = Officework::where('oid', $id)
		->first();
		
		$vids = VolunteerOfficework::where('oid', $id)->pluck('vid');
		
		//Volunteer::whereIn('vid', $vids)
		//->decrement('acc_serve_hour', $officework->serve_hour);
		
		$vos = VolunteerOfficework::where('oid', $id)->delete();
		$officework->delete();
        return redirect()->route('officework.index')->with('success','Administrative work deleted successfully');
    }
	
}
