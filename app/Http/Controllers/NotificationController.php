<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\AdminAccount;
use App\VolunteerAccount;
use App\Volunteer;
use App\Programme;
use App\ProgrammeImage;
use App\InterestedProgramme;
use App\Officework;
use App\Event;
use App\Notification;
use App\AwardHistory;
use App\Skillset;
use App\VolunteerEvent;
use App\VolunteerNotification;
use App\VolunteerOfficework;

class NotificationController extends Controller
{
	public function index()
	{
		$auth = session('authority');
		$vid = session('user_id');
		$npp = 10;
		$broadcastnotifications = Notification::where('broadcast', 1);
		$notifications = DB::table('notifications as n')
		->where('broadcast', 0);
		
		if( $auth == 'admin')
		{
			$broadcastnotifications = $broadcastnotifications->where('for_admin', 1);
			$notifications = $notifications->where('for_admin', 1);
		}
		else if($auth == 'volunteer')
		{
			$broadcastnotifications = $broadcastnotifications->where('for_volunteer', 1);
			$notifications = $notifications
			->join('volunteer_notifications as vn', 'vn.nid', '=','n.nid')
			->where('vn.vid', $vid)
			->where('n.for_volunteer', 1);
		}
		
		$broadcastnotifications = $broadcastnotifications
		->orderby('created_at', 'desc')
		->get();
		
		$notifications = $notifications->orderby('created_at', 'desc')
		->paginate($npp);
		
		
		return view('notification.index', ['notifications' => $notifications, 'broadcastnotifications'=>$broadcastnotifications, 'notification_per_page' => $npp]);
	}
	
	//Must present if creating is present
    public function create()
    {
		return view('notification.create');
    }
	
	//Must present if storing data into database is required
	public function store(Request $request)
    {
		$this->validate($request, [
			'title'		 	=> 'required|max:100',
			'description'	=> 'required|max:1000',
			'category'	=> 'required',
			'created_by'	=> 'required|max:100',
		]);
		
		$type = $request->get('type');
		switch($type)
		{
			case 1:
				$notification = new Notification([
					'title'			=>	$request->get('title'),
					'description'	=>	$request->get('description'),
					'category'		=>	$request->get('category'),
					'created_by'	=>	$request->get('created_by'),
					'broadcast'		=> 1
				]);
				$notification -> save();
			break;
			case 2:
				$notification = new Notification([
					'title'			=>  $request->get('title'),
					'description'	=>  $request->get('description'),
					'category'		=>	$request->get('category'),
					'created_by'	=>	$request->get('created_by'),
				]);
				$notification -> save();
				$volunteers = Volunteer::select('volunteers.vid')->get();
				foreach( $volunteers as $volunteer )
				{
					$vol_notif = new VolunteerNotification([
						'vid' => $volunteer->vid,
						'nid' => $notification->nid
					]);
					$vol_notif->save();
				}
			break;
			case 3; break;
		}
		
		return redirect()->route('notification.create')->with('success', 'Notification added successfully.');
	}
	
	//Must present if want to show a web page
	 public function show($id)
    {
		$notification = Notification::findOrFail($id);
		return view('notification.show', ['notification'=>$notification]);
    }
	
	//Must present if edit is present
	 public function edit($id)
    {
		$notification = Notification::findOrFail($id);
		return view('notification.edit', ['notification'=>$notification]);
    }
	
	//Must present if edit is present
    public function update(Request $request, $id)
    {
		$notification = Notification::findOrFail($id);
		
		$this->validate($request, [
			'title'		 	=> 'required|max:100',
			'description'	=> 'required|max:1000',
			'category'		=> 'required',
		]);
		
		$notification->title = $request->get('title');
		$notification->description = $request->get('description');
		$notification->category = $request->get('category');
		
		$notification->save();
		return redirect()->route('notification.show',$id)->with('success', 'Notification updated successfully.');
    }
	
    public function destroy($id)
    {
		try
		{
			$notification = Notification::where('nid', $id)
			->firstOrFail();
			
			$vn = VolunteerNotification::where('nid', $notification->nid)
			->delete();
			
			$notification->delete();
			
			return redirect()->route('notification.index')->with('success','Notification deleted successfully');
		}
		catch(\ModelNotFoundException $e)
		{
			return redirect()->route('home');
		}
		catch(\Exception $e)
		{
			return redirect()->route('notification.show')->with('fail', 'Something went wrong, please try again.');
		}
    }
	
	public function send(Request $request)
	{
		$this->validate($request, [
			'title'		 	=> 'required|max:100',
			'description'	=> 'required|max:600',
			'category'		=> 'required',
			'created_by'	=> 'required|max:100',
		]);
		
		$type = $request->get('type');
		switch($type)
		{
			case 1:
				$notification = new Notification([
					'title'			=> $request->get('title'),
					'description'	=> $request->get('description'),
					'category'		=> $request->get('category'),
					'created_by'	=> $request->get('created_by'),
					'broadcast'		=> 1,
					'for_volunteer'	=> $request->get('for_volunteer'),
					'for_admin'		=> $request->get('for_admin'),
					'is_auto'		=> $request->get('is_auto')
				]);
				$notification -> save();
			break;
			case 2:
				$notification = new Notification([
					'title'			=>  $request->get('title'),
					'description'	=>  $request->get('description'),
					'category'		=> $request->get('category'),
					'created_by'	=> $request->get('created_by'),
					'for_volunteer'	=> $request->get('for_volunteer'),
					'for_admin'		=> $request->get('for_admin'),
					'is_auto'		=> $request->get('is_auto')
				]);
				$notification -> save();
				$volunteers = Volunteer::select('volunteers.vid')->get();
				foreach( $volunteers as $volunteer )
				{
					$vol_notif = new VolunteerNotification([
						'vid' => $volunteer->vid,
						'nid' => $notification->nid
					]);
					$vol_notif->save();
				}
			break;
			case 3; break;
		}
		return ['success' => 'notification added'];
	}
}
