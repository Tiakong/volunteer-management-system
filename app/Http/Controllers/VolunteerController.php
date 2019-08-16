<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Common;
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
use Illuminate\Support\Facades\Session;
use DB;

class VolunteerController extends Controller
{
	public function register()
	{
		$Programme = Programme::orderBy('name','asc')->get();
		$Volunteer = new Volunteer();
		return view('register',[
			'programmes' => $Programme,
			'volunteer' => $Volunteer,
		]);
	}

	public function store(Request $request)
	{
		$this->validate($request, [
					'username'		=> 'required|unique:volunteer_accounts,username',
					'name'		 	=> 'required|max:100',
					'nric' 			=> 'required|regex:/[0-9]{12}/',
					'gender'		=> 'required',
					'nationality' 	=> 'required',
					'race' 			=> 'required',
					'email' 		=> 'required|email|max:255|unique:volunteer_accounts,username',
					'contact_no' 	=> 'required|regex:/(01)[0-9]/|min:10',
					'address' 		=> 'required',
					'em_person' 	=> 'required|max:100',
					'em_contact_no' => 'required|regex:/(01)[0-9]/|min:10',
					'em_relation' 	=> 'required',
					'education_level' => 'required',
					'occupation' 	=> 'required',
					't_shirt_size' => 'required',
					'programme' => 'nullable',
					'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1999',
					'password' => 'required|min:6|confirmed',
		]);

		if($request->hasFile('profile_image')){
			$filenameWithExt=$request->file('profile_image')->getClientOriginalName();
			$filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);
			$extension=$request->file('profile_image')->getClientOriginalExtension();
			$fileNameToStore=$filename.'_'.time().'.'.$extension;
			$path=$request->file('profile_image')->storeAs('public/profile_image',$fileNameToStore);
		  }else{
			$fileNameToStore='default_image.png';
		  }

		$volunteer_number = \DB::table('volunteers')->count();
		$id = "ccv".str_pad($volunteer_number+1, 5, '0', STR_PAD_LEFT);

		$register = new Volunteer([
			'id'                => $id,
			'name'				=>  $request->get('name'),
			'nric' 				=> $request->get('nric'),
			'email' 			=> $request->get('email'),
			'contact_no' 		=> $request->get('contact_no'),
			'gender'			=> $request->get('gender'),
			'race' 				=> $request->get('race'),
			'nationality' 		=> $request->get('nationality'),
			'address' 			=> $request->get('address'),
			'education_level'	=> $request->get('education_level'),
			'occupation' 		=> $request->get('occupation'),
			't_shirt_size'		=> $request->get('t_shirt_size'),
			'em_person' 		=> $request->get('em_person'),
			'em_contact_no' 	=> $request->get('em_contact_no'),
			'em_relation' 		=> $request->get('em_relation'),
			'remark' => $request->get('remark')
		]);

		$register->acc_serve_hour = 0;
		$register->last_active_date = date("Y-m-d H:i:s");
		$register->profile_image=$fileNameToStore;
		$register -> save();


		$volunteer_id = \DB::table('volunteers')->where('name',$request->get('name'))->value('vid');

		$volunteer_acc = new VolunteerAccount([
			'vid' => $volunteer_id,
			'username' => $request->get('username'),
			'password' => \Hash::make($request->get('password'))

			]);

		$volunteer_acc->save();

		foreach(Common::getProgrammes() as $pcode => $pname){
			if($request->has($pcode)){
				$programme_id = \DB::table('programmes')->where('code',$pcode)->value('pid');

				$interested_programme = new InterestedProgramme([
					'vid' => $volunteer_id,
					'pid' => $programme_id
				]);

				$interested_programme->save();
			}
		}


		$skillsets = new Skillset();

		$skillsets->vid = $volunteer_id;

		if($request->get('langEN')!=null){
			$skillsets->langEN = $request->get('langEN');
		}

		if($request->get('langZH')!=null){
			$skillsets->langZH = $request->get('langZH');
		}

		if($request->get('langMS')!=null){
			$skillsets->langMS = $request->get('langMS');
		}

		if($request->get('langHI')!=null){
			$skillsets->langHI = $request->get('langHI');
		}

		if($request->get('mcrWord')!=null){
			$skillsets->mcrWord = $request->get('mcrWord');
		}

		if($request->get('mcrExcel')!=null){
			$skillsets->mcrExcel = $request->get('mcrExcel');
		}

		if($request->get('mcrPowerPoint')!=null){
			$skillsets->mcrPowerPoint = $request->get('mcrPowerPoint');
		}

		if($request->get('pgrCpp')!=null){
			$skillsets->pgrCpp = $request->get('pgrCpp');
		}

		if($request->get('pgrJs')!=null){
			$skillsets->pgrJs = $request->get('pgrJs');
		}

		if($request->get('pgrPhp')!=null){
			$skillsets->pgrPhp = $request->get('pgrPhp');
		}

		if($request->get('pgrSql')!=null){
			$skillsets->pgrSql = $request->get('pgrSql');
		}

		if($request->get('pgrPython')!=null){
			$skillsets->pgrPython = $request->get('pgrPython');
		}

		if($request->get('dsgPhotoshop')!=null){
			$skillsets->dsgPhotoshop = $request->get('dsgPhotoshop');
		}

		if($request->get('dsgIllustrator')!=null){
			$skillsets->dsgIllustrator = $request->get('dsgIllustrator');
		}

		if($request->get('dsgPremiumPro')!=null){
			$skillsets->dsgPremiumPro = $request->get('dsgPremiumPro');
		}

		if($request->get('edgnAutocad')!=null){
			$skillsets->edgnAutocad = $request->get('edgnAutocad');
		}

		if($request->get('edgnSolidWorks')!=null){
			$skillsets->edgnSolidWorks = $request->get('edgnSolidWorks');
		}


		if($request->has('funding')){
			$skillsets->funding = $request->get('funding');
		}

		if($request->has('branding')){
			$skillsets->branding = $request->get('branding');
		}


		if($request->has('entrepreneurship')){
			$skillsets->entrepreneurship = $request->get('entrepreneurship');
		}

		if($request->has('dgtIT')){
			$skillsets->dgtIT = $request->get('dgtIT');
		}

		if($request->has('dgtMultimedia')){
			$skillsets->dgtMultimedia = $request->get('dgtMultimedia');
		}

		if($request->has('dgtSocialMedia')){
			$skillsets->dgtSocialMedia = $request->get('dgtSocialMedia');
		}

		if($request->has('ctvArt')){
			$skillsets->ctvArt = $request->get('ctvArt');
		}

		if($request->has('ctvDraw')){
			$skillsets->ctvDraw = $request->get('ctvDraw');
		}

		if($request->has('ctvDance')){
			$skillsets->ctvDance = $request->get('ctvDance');
		}

		if($request->has('ctvThretre')){
			$skillsets->ctvThretre = $request->get('ctvThretre');
		}

		if($request->has('ctvMusic')){
			$skillsets->ctvMusic = $request->get('ctvMusic');
		}

		if($request->has('cmmMarket')){
			$skillsets->cmmMarket = $request->get('cmmMarket');
		}

		if($request->has('cmmMedia')){
			$skillsets->cmmMedia = $request->get('cmmMedia');
		}

		if($request->has('cmmPresentation')){
			$skillsets->cmmPresentation = $request->get('cmmPresentation');
		}

		if($request->has('business')){
			$skillsets->business = $request->get('business');
		}

		$skillsets->save();



		return redirect()->route('login')->with('success', 'Register successfully.');
	}

	//Must present if want to show a web page
	 public function show()
    {
		$id = Session::get('user_id');
		
		$Volunteer = Volunteer::find($id);
		if(!$Volunteer) throw new ModelNotFoundException;

		$programme = DB::table('interested_programmes as ip')
		->where('vid',$id)
		->join('programmes as p', 'p.pid', '=', 'ip.pid')
		->select('p.name','p.code')
		->get();

		$skillsets = Skillset::where('vid', $id)->first();
		$skillset = json_decode(json_encode($skillsets), true);

		return view('volunteer.show',[
			'volunteer' => $Volunteer,
			'programme' => $programme,
			'skillset' => $skillset,
			'skillsetslist' =>$skillsets,
		]);
	}

	public function show_by_search($id)
    {
		$Volunteer = Volunteer::find($id);
		if(!$Volunteer) throw new ModelNotFoundException;

		$programme = DB::table('interested_programmes as ip')
		->where('vid',$id)
		->join('programmes as p', 'p.pid', '=', 'ip.pid')
		->select('p.name','p.code')
		->get();

		$skillsets = Skillset::where('vid', $id)->first();
		$skillset = json_decode(json_encode($skillsets), true);

		return view('volunteer.show',[
			'volunteer' => $Volunteer,
			'programme' => $programme,
			'skillset' => $skillset,
			'skillsetslist' =>$skillsets,
		]);
	}

	public function get_volunteer($id)
    {

		$Volunteer = Volunteer::find($id);
		if(!$Volunteer) throw new ModelNotFoundException;

		$programme = DB::table('interested_programmes as ip')
		->where('vid',$id)
		->join('programmes as p', 'p.pid', '=', 'ip.pid')
		->select('p.name','p.code')
		->get();

		$skillsets = Skillset::where('vid', $id)->first();
		$skillset = json_decode(json_encode($skillsets), true);

		return view('volunteer.show',[
			'volunteer' => $Volunteer,
			'programme' => $programme,
			'skillset' => $skillset,
			'skillsetslist' =>$skillsets,
		]);
    }

	//Must present if edit is present
	 public function edit($id)
    {$id = Session::get('user_id');
		$Volunteer = Volunteer::find($id);
		if(!$Volunteer) throw new ModelNotFoundException;

		$programme = DB::table('interested_programmes as ip')
		->where('vid',$id)
		->join('programmes as p', 'p.pid', '=', 'ip.pid')
		->get();

		$skillsets = Skillset::where('vid', $id)->first();
		$skillset = json_decode(json_encode($skillsets), true);

		return view('volunteer.edit',[
			'volunteer' => $Volunteer,
			'programmes' => $programme,
			'skillset' => $skillset,
			'skillsetslist' =>$skillsets,
		]);
    }

	//Must present if edit is present
    public function update(Request $request)
    {
		$this->validate($request, [
			'name'		 	=> 'required|max:100',
			'nric' 			=> 'required|regex:/[0-9]{12}/',
			'gender'		=> 'required',
			'nationality' 	=> 'required',
			'race' 			=> 'required',
			'email' 		=> 'required|email|max:255',
			'contact_no' 	=> 'required|regex:/(01)[0-9]/|min:10',
			'address' 		=> 'required',
			'em_person' 	=> 'required|max:100',
			'em_contact_no' => 'required|regex:/(01)[0-9]/|min:10',
			'em_relation' 	=> 'required',
			'education_level' => 'required',
			'occupation' 	=> 'required',
			'programme' => 'nullable',
			'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1999',

		]);

		if($request->hasFile('profile_image')){
			$filenameWithExt=$request->file('profile_image')->getClientOriginalName();
			$filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);
			$extension=$request->file('profile_image')->getClientOriginalExtension();
			$fileNameToStore=$filename.'_'.time().'.'.$extension;
			$path=$request->file('profile_image')->storeAs('public/profile_image',$fileNameToStore);
		}else{
			$fileNameToStore='default_image.png';
		}

		$id = Session::get('user_id');
		$update_volunteer = Volunteer::find($id);
		$update_volunteer->name = $request->get('name');
		$update_volunteer->nric = $request->get('nric');
		$update_volunteer->email = $request->get('email');
		$update_volunteer->contact_no = $request->get('contact_no');
		$update_volunteer->gender = $request->get('gender');
		$update_volunteer->race = $request->get('race');
		$update_volunteer->nationality = $request->get('nationality');
		$update_volunteer->address = $request->get('address');
		$update_volunteer->education_level = $request->get('education_level');
		$update_volunteer->occupation = $request->get('occupation');
		$update_volunteer->remark = $request->get('remark');
		$update_volunteer->em_person = $request->get('em_person');
		$update_volunteer->em_contact_no = $request->get('em_contact_no');
		$update_volunteer->em_relation = $request->get('em_relation');

		$update_volunteer->profile_image=$fileNameToStore;
		$update_volunteer->save();

		\DB::table('interested_programmes')->where('vid',$id)->delete();

		foreach(Common::getProgrammes() as $pcode => $pname){
			if($request->has($pcode)){
				$programme_id = \DB::table('programmes')->where('code',$pcode)->value('pid');

				$interested_programme = new InterestedProgramme([
					'vid' => $id,
					'pid' => $programme_id
				]);

				$interested_programme->save();
			}
		}

		\DB::table('skillsets')->where('vid',$id)->delete();

		$skillsets = new Skillset();

		$skillsets->vid = $id;

		if($request->get('langEN')!=null){
			$skillsets->langEN = $request->get('langEN');
		}

		if($request->get('langZH')!=null){
			$skillsets->langZH = $request->get('langZH');
		}

		if($request->get('langMS')!=null){
			$skillsets->langMS = $request->get('langMS');
		}

		if($request->get('langHI')!=null){
			$skillsets->langHI = $request->get('langHI');
		}

		if($request->get('mcrWord')!=null){
			$skillsets->mcrWord = $request->get('mcrWord');
		}

		if($request->get('mcrExcel')!=null){
			$skillsets->mcrExcel = $request->get('mcrExcel');
		}

		if($request->get('mcrPowerPoint')!=null){
			$skillsets->mcrPowerPoint = $request->get('mcrPowerPoint');
		}

		if($request->get('pgrCpp')!=null){
			$skillsets->pgrCpp = $request->get('pgrCpp');
		}

		if($request->get('pgrJs')!=null){
			$skillsets->pgrJs = $request->get('pgrJs');
		}

		if($request->get('pgrPhp')!=null){
			$skillsets->pgrPhp = $request->get('pgrPhp');
		}

		if($request->get('pgrSql')!=null){
			$skillsets->pgrSql = $request->get('pgrSql');
		}

		if($request->get('pgrPython')!=null){
			$skillsets->pgrPython = $request->get('pgrPython');
		}

		if($request->get('dsgPhotoshop')!=null){
			$skillsets->dsgPhotoshop = $request->get('dsgPhotoshop');
		}

		if($request->get('dsgIllustrator')!=null){
			$skillsets->dsgIllustrator = $request->get('dsgIllustrator');
		}

		if($request->get('dsgPremiumPro')!=null){
			$skillsets->dsgPremiumPro = $request->get('dsgPremiumPro');
		}

		if($request->get('edgnAutocad')!=null){
			$skillsets->edgnAutocad = $request->get('edgnAutocad');
		}

		if($request->get('edgnSolidWorks')!=null){
			$skillsets->edgnSolidWorks = $request->get('edgnSolidWorks');
		}


		if($request->has('funding')){
			$skillsets->funding = $request->get('funding');
		}

		if($request->has('branding')){
			$skillsets->branding = $request->get('branding');
		}


		if($request->has('entrepreneurship')){
			$skillsets->entrepreneurship = $request->get('entrepreneurship');
		}

		if($request->has('dgtIT')){
			$skillsets->dgtIT = $request->get('dgtIT');
		}

		if($request->has('dgtMultimedia')){
			$skillsets->dgtMultimedia = $request->get('dgtMultimedia');
		}

		if($request->has('dgtSocialMedia')){
			$skillsets->dgtSocialMedia = $request->get('dgtSocialMedia');
		}

		if($request->has('ctvArt')){
			$skillsets->ctvArt = $request->get('ctvArt');
		}

		if($request->has('ctvDraw')){
			$skillsets->ctvDraw = $request->get('ctvDraw');
		}

		if($request->has('ctvDance')){
			$skillsets->ctvDance = $request->get('ctvDance');
		}

		if($request->has('ctvThretre')){
			$skillsets->ctvThretre = $request->get('ctvThretre');
		}

		if($request->has('ctvMusic')){
			$skillsets->ctvMusic = $request->get('ctvMusic');
		}

		if($request->has('cmmMarket')){
			$skillsets->cmmMarket = $request->get('cmmMarket');
		}

		if($request->has('cmmMedia')){
			$skillsets->cmmMedia = $request->get('cmmMedia');
		}

		if($request->has('cmmPresentation')){
			$skillsets->cmmPresentation = $request->get('cmmPresentation');
		}

		if($request->has('business')){
			$skillsets->business = $request->get('business');
		}

		$skillsets->save();




      return redirect()->route('volunteer.show')->with('success', 'Updated successfully.');


	}

	public function password(Request $request){
		return view('volunteer.password');
	}

	public function update_password(Request $request){

		$volunteer_acc = VolunteerAccount::where('vid',Session::get('user_id'))->first();

		$this->validate($request, [
			'old_password' => 'required',
			'new_password' => 'required|confirmed',
			'new_password_confirmation' => 'required'
		]);

		if( \Hash::check($request->get('old_password'), $volunteer_acc->password))
		{
			$new_password = \Hash::make($request->get('new_password'));
			\DB::table('volunteer_accounts')->where('vid',Session::get('user_id'))->update(['password'=>$new_password]);

			return redirect()->route('logout')->with('success', ' Password updated successfully. Please login again');
		}
		else
		{
			return redirect()->route('volunteer.password')->with('alert', 'incorrect current passowrd.');
		}




	}
}
