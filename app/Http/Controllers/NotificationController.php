<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\NotificationMessage;
use App\HasSendReminder;
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
		$npp = 2;
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
			'category'		=> 'required',
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
			case 3;
				$programme_code	= $request->get('programme_code');
				$eid			= $request->get('event_title');
				$dateFrom 		= $request->get('date_from');
				$dateTo			= $request->get('date_to');
				
				$notification = new Notification([
					'title'			=>  $request->get('title'),
					'description'	=>  $request->get('description'),
					'category'		=>	$request->get('category'),
					'created_by'	=>	$request->get('created_by'),
				]);
				$notification -> save();
				
				$vids = VolunteerEvent::where('eid', $eid)
				->pluck('vid');
				
				foreach($vids as $vid)
				{
					$vn = new VolunteerNotification([
						'vid'		=>	$vid,
						'nid'		=>	$notification->nid,
						'read_at'	=>	null
					]);
					$vn->save();
				}
				
			break;
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
		if(Session::get('authority')!='admin'){
			return redirect('/');
		}
		$notification = Notification::findOrFail($id);
		return view('notification.edit', ['notification'=>$notification]);
    }
	
	//Must present if edit is present
    public function update(Request $request, $id)
    {
		if(Session::get('authority')!='admin'){
			return redirect('/');
		}
		$this->validate($request, [
			'title'		 	=> 'required|max:100',
			'description'	=> 'required|max:1000',
			'category'		=> 'required',
		]);
		
		$notification = Notification::findOrFail($id);
		$notification->title		= $request->get('title');
		$notification->description	= $request->get('description');
		$notification->category 	= $request->get('category');
		$notification->save();
		
		return redirect()->route('notification.show',$id)->with('success', 'Notification updated successfully.');
    }
	
    public function destroy($id)
    {
		if(Session::get('authority')!='admin'){
			return redirect('/');
		}
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
	
	public function read(Request $request)
	{
		if(Session::get('user_id')==''){
			return redirect('/');
		}
		$nid = $request->get('nid');
		$vid = Session::get('user_id');
		
		$vn = VolunteerNotification::where('vid', $vid)->where('nid', $nid)->first();
		$vn->read_at = Carbon::now();
		$vn->save();
	}
	
	//Send notification from javascript
	public function send(Request $request)
	{
		if(Session::get('authority')!='admin'){
			return redirect('/');
		}
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
			case 3:
			
				foreach($vids as $vid)
				{
					$vn = new VolunteerNotification([
						'vid'		=>	$vid,
						'nid'		=>	$notification->nid,
						'read_at'	=>	null
					]);
					$vn->save();
				}
			break;
		}
		return ['success' => 'notification added'];
	}
	
	public static function sendReminder()
	{
		if(Session::get('authority')!='admin'){
			return redirect('/');
		}
		//Send reminder notification only if today has not yet send
			
		//get the list of eid that is already sent reminder, we don't want to send duplicate in same day.
		$already_sent_reminder = DB::table("has_send_reminder")
		->whereDate('created_at', '=', Carbon::parse(Carbon::now())->format('Y-m-d'))
		->pluck('eid');
	
		//Filter all events that are held 3 days and 1 day from today and haven't send reminder for today.
		$events = Event::whereDate('date', '=', Carbon::parse(Carbon::now()->addDays(3))->format('Y-m-d'))
		->union(
			Event::whereDate('date', '=', Carbon::parse(Carbon::now()->addDays(1))->format('Y-m-d'))
			)
		->whereNotIn('eid', $already_sent_reminder)
		->get();
		
		foreach($events as $e)
		{
			$eid = $e->eid;
			$hsr = HasSendReminder::where('eid', $eid)->first();
			if( $hsr ) //Update if exist
				$hsr->created_at = Carbon::now();
			else //Create new record if not exist
				$hsr = new HasSendReminder(['eid' => $eid]);
			$hsr->save();
			
			$vids = VolunteerEvent::where('eid', $eid)->pluck('vid');
			if(count($vids)>0)
			{
				$datediff = Carbon::parse($e->date)->diffInDays(Carbon::now()->format('Y-m-d'));
				$html = "<a href='".route('event.show', $eid)."'>".$e->name."</a>";
				//Hard coded title and description
				$title = sprintf(NotificationMessage::$notify_reminder['title'], 
				$datediff, 
				($datediff==1?'':'s'), 
				$e->name);
				$description = sprintf(NotificationMessage::$notify_reminder['description'], 
				$html, 
				Carbon::parse($e->date)->format('d M Y'));
				
				//Create notification
				$notification = new Notification([
					'title'			=> $title,
					'description'	=> $description,
					'category'		=> '3',
					'broadcast'		=> 0,
					'for_volunteer'	=> 1,
					'for_admin'		=> 1,
					'is_auto'		=> 1,
				]);
				$notification->save();
			
				foreach($vids as $vid)
				{
					$vn = new VolunteerNotification([
						'vid' => $vid,
						'nid' => $notification->nid
					]);
					$vn->save();
				}
			}
		}
	}
}


