<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\AdminAccount;
use App\NotificationMessage;
use App\VolunteerAccount;
use App\Volunteer;
use App\Event;
use App\Programme;
use App\Officework;
use App\Notification;
use App\AwardHistory;
use App\Skillset;
use App\Pinnotification;
use App\VolunteerEvent;
use App\VolunteerNotification;
use App\VolunteerOfficework;
use Illuminate\Support\Facades\Session;

class EventController extends Controller
{
	public function index()
	{
		if((Session::get('authority')) == 'volunteer'){
			return view('event.volunteer-show',[
				'events' => null,
				'flag' => 0,
				'programme' => null
			]);
		}
		elseif((Session::get('authority')) == 'admin'){
			return view('event.admin-show',[
			  'events' => null,
			  'flag' => 0,
			  'programme' => null
			]);
		}
		else
		{
			return redirect()->route('/');
		}
	}
	
    public function create()
    {
        if(Session::get('authority')!='admin')
			return redirect('/');
	
        $event = new Event();

        return view('event.create',[
			'event' => $event,
        ]);
    }
	
	public function store(Request $request)
	{
        if(Session::get('authority')!='admin'){
          return redirect('/');
        }
		//take program id from database match with program name and insert program id 
		$program = \DB::table('programmes')
		->where('code', $request->input('programme-title'))
		->first();
		
		$start_date = date('Y-m-d',strtotime($program->start_year.'-'.$program->start_month.'-01'));
		
		$int_end_month = (int) $program->end_month + 1;
		$int_end_year = $program->end_year;
		if($int_end_month > 12){
			$int_end_year += 1; 
			$int_end_month = 1;
		}
		$end_date = date('Y-m-d',strtotime($int_end_year.'-'.$int_end_month.'-01'));
		/************** Validate input ******************/
		$validatedData = $request->validate([
		  'programme-title' => 'required',
		  'name' => 'required|unique:events,name',
		  'date' => 'required|after_or_equal:'.$start_date.'|after:today|before:'.$end_date,
		  'start_time' => 'required|after:'.date('h:i a',strtotime('6:00 am')),
		  'end_time' => 'required|before:'.date('h:i a',strtotime('11:59 pm')).'|after:start_time',
		  'venue' => 'required',
		  'description' => 'required|max:600',
		  'created_by' => 'required',
		  'cover_image' => 'image|nullable|max:1999'
		]);

		if($request->hasFile('cover_image')){
			//refer to laravel tutorial 12
			$fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
			$filename = pathinfo($fileNameWithExt,PATHINFO_FILENAME);
			$extension = $request->file('cover_image')->guessClientExtension();
			$fileNameToStore = $filename.'_'.time().'.'.$extension;
			$path = $request->file('cover_image')->storeAs('public/cover_image',$fileNameToStore);
		}
		else
		{
			$fileNameToStore = 'default_image.png';
		}
			
		$event = new Event;
		
		$event->pid = $program->pid;
		$serve_hour = (strtotime($request->end_time) - strtotime($request->start_time))/3600;
		$event->serve_hour = $serve_hour;
		$event->cover_image = $fileNameToStore;
		$event->fill($request->except('programme-title','cover_image'));
		$event->save();

		//send notification to all volunteers
		$html = "<a href='".route('event.show-detail', $event->eid)."'>here</a>";
		$notification = new Notification;
		$notification->title = sprintf(NotificationMessage::$notify_new_event['title'],
		$request->name);
		$notification->description = sprintf(NotificationMessage::$notify_new_event['description'],
		$html);
		$notification->for_volunteer = 1;
		$notification->is_auto = 1;
		$notification->category = 2;
		$notification->save();
		
		foreach(Volunteer::all() as $v)
		{
			$vn = new VolunteerNotification([
				'vid' => $v->vid,
				'nid' => $notification->nid
			]);
			$vn->save();
		}
		
		return redirect()->route('event.index')->with('alert', 'Event created successfully!');
	}
	
	public function show($code)
	{
      if(!Session::has('authority')){
        return redirect('/');
      }
	  
	  if(Session::get('authority')=='admin')
	  {
		  $programme_id = \DB::table('programmes')
		  ->where('code',$code)
		  ->value('pid');
		  
		  $flag = 0;
		  $programme_name = null;
		  if($programme_id != null){
			$flag = 1;
			$programme_name = \DB::table('programmes')
			->where('code',$code)
			->value('name');
		  }else{
			$flag = 0;
		  }

		  $events = Event::where('pid',$programme_id)
		  ->orderBy('date','asc')
		  ->get();

		  return view('event.admin-show',[
			'events' => $events,
			'programme' => $code,
			'pname' => $programme_name,
			'flag' => $flag
		  ]);
	  }
	  elseif(Session::get('authority')=='volunteer')
	  {
		  $programme_id = \DB::table('programmes')->where('code',$code)->value('pid');
		  $programme_name = null;
		  $flag = 0;
		  if($programme_id != null){
			$flag = 1;
			$programme_name = \DB::table('programmes')->where('code',$code)->value('name');
		  }else{
			$flag = 0;
		  }

		  $events = Event::where('pid',$programme_id)
		  ->orderBy('date','asc')
		  ->get();

		  return view('event.volunteer-show',[
			'events' => $events,
			'programme' => $code,
			'pname' => $programme_name,
			'flag' => $flag
		  ]);
	  }
	  
    }
	
    public function show_detail($id)
    {
      if(!Session::has('authority')){
        return redirect('/');
      }
	  
	  if(Session::get('authority')=="admin")
	  {
		  $event = Event::find($id);
		  if(!$event) throw new ModelNotFoundException;

		  return view('event.admin-show-detail',[
			'event' => $event
		  ]);
	  }
	  
	  elseif(Session::get('authority')=="volunteer")
	  {
		  $event = Event::find($id);
		  if(!$event) throw new ModelNotFoundException;
		  
		  $has_reserved = \DB::table('volunteer_events')
		  ->where('vid',Session::get('user_id'))
		  ->where('eid',$id)
		  ->first();

		  return view('event.volunteer-show-detail',[
			'event' => $event,
			'has_reserved' => $has_reserved
		  ]);
	  }
    }

	 public function edit($id)
    {
      if(Session::get('authority')!='admin'){
        return redirect('/');
      }
      $event = Event::find($id);
      $programme_name = \DB::table('programmes')->where('pid',$event->pid)->value('name');
      
      if(!$event) throw new ModelNotFoundException;
		  return view('event.edit',[
        'event' => $event,
        'programme_name' => $programme_name
      ]);
    }
	
    public function update(Request $request, $id)
    {
      $event = Event::find($id);
      if(!$event) throw new ModelNotFoundException;

      $program = \DB::table('programmes')->where('pid',$request->input('pid'))->first();
      $start_date = date('Y-m-d',strtotime($program->start_year.'-'.$program->start_month.'-01'));
      $int_end_month = (int) $program->end_month + 1;
      $int_end_year = $program->end_year;
      if($int_end_month>12){
        $int_end_year += 1; 
        $int_end_month = 1;
      }
      $end_date = date('Y-m-d',strtotime($int_end_year.'-'.$int_end_month.'-01'));

      $validatedData = $request->validate([
        'programme-title' => 'nullable',
        'name' => 'required',
        'date' => 'required|after_or_equal:'.$start_date.'|after:today|before:'.$end_date,
        'start_time' => 'required|after:'.date('h:i a',strtotime('6:00 am')),
        'end_time' => 'required|before:'.date('h:i a',strtotime('11:59 pm')).'|after:start_time',
        'venue' => 'required',
        'description' => 'required|max:600',
        'created_by' => 'required',
        'cover_image' => 'image|nullable|max:1999'
      ]);

      if($request->hasFile('cover_image')){
        //refer to laravel tutorial 12
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            $filename = pathinfo($fileNameWithExt,PATHINFO_FILENAME);
            $extension = $request->file('cover_image')->guessClientExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('cover_image')->storeAs('public/cover_image',$fileNameToStore);
            $event->cover_image = $fileNameToStore;
        }

      
      $event->pid = $program->pid;
      $serve_hour = (strtotime($request->end_time) - strtotime($request->start_time))/3600;
      $event->serve_hour = $serve_hour;
	  $original_date = $event->date;
	  $new_date = $request->input('date');
      
      $event->fill($request->except('programme-title','cover_image'));
      $event->save();
      if($new_date!=$original_date)
	  {
		  $registered_volunteers = \DB::table('volunteer_events')->where('eid',$id)->get();
		  
		  if(count($registered_volunteers)>0){
			$html = "<a href='".route('event.show-detail', $id)."' target='_blank'>".$request->name."</a>";
			$notification = new Notification;
			$notification->title = sprintf(NotificationMessage::$notify_edit_event['title'],
			$request->name);
			$notification->description = sprintf(NotificationMessage::$notify_edit_event['description'],
			$html,
			$new_date>$original_date?'preponed':'postponed',
			$new_date);
			$notification->created_by = $request->input('created_by');
			$notification->category = 2;
			$notification->save();

			foreach($registered_volunteers as $registered_volunteer){
			  $volunteer_notification = new VolunteerNotification;
			  $volunteer_notification->vid = $registered_volunteer->vid;
			  $volunteer_notification->nid = $notification->nid;
			  $volunteer_notification->save();
			}
		}
	  }
      return redirect()->route('event.show-detail',[$event->eid])->with('alert', 'Event edited successfully!');
    }
	
    public function destroy($id)
	{
		$event = \DB::table('events')->where('eid',$id)->first();
		//Don't allow to delete if the event is finished.
		dd(Carbon::parse($event->date)->datediff(Carbon::now()));
		if(true)
		{
			return redirect()->route('event.index')->with('alert', 'Cannot delete this event!');
		}
	
		$registered_volunteers = \DB::table('volunteer_events')->where('eid',$id)->get();
    if(count($registered_volunteers)>0){
      $notification = new Notification;
      $notification->title = ' Event ['.$event->name.'] is removed';
      $notification->description = 'Due to some issues, the event named: ['.$event->name.'] has been removed.
	  
	  !';
      $notification->for_volunteer = 1;
      $notification->for_admin = 0;
      $notification->broadcast = 0;
      $notification->is_auto = 1;
      $notification->created_by = $event->created_by;
      $notification->category = 2;
      $notification->save();

      foreach($registered_volunteers as $registered_volunteer){
        $volunteer_notification = new VolunteerNotification;
        $volunteer_notification->vid = $registered_volunteer->vid;
        $volunteer_notification->nid = $notification->nid;
        $volunteer_notification->save();
        \DB::table('volunteer_events')->where('eid',$id)->where('vid',$registered_volunteer->vid)->delete();
      }
    }
      \DB::table('events')->where('eid',$id)->delete();
	  VolunteerEvent::where('eid', $id)->delete();
        return redirect()->route('event.index')->with('alert', 'Event deleted successfully!');    
    }

    public function reserve($id)
    {
		$new_reservation = new VolunteerEvent();

		$new_reservation->vid =  Session::get('user_id');
		$new_reservation->eid =  $id;
		$new_reservation->status =  '';
		$new_reservation->remark =  '';
		$new_reservation->serve_hour =  0;

		$new_reservation->save();

		$volunteer = \DB::table('volunteers')->where('vid',Session::get('user_id'))->first();
		$event = \DB::table('events')->where('eid',$id)->first();
		
		/*
		//Send notification to admin whenever a volunteer reserve an event.
		$number_of_volunteer = \DB::table('volunteer_events')->where('eid',$id)->counte();
		$notification = new Notification;
		$notification->title = $volunteer->name.'has joined the event ['.$event->name.']!';
		$notification->description = $volunteer->name.'has joined the event ['.$event->name.']!. The total number of volunteer for the event is '.$number_of_volunteer.' people.';
		$notification->for_volunteer = 0;
		$notification->for_admin = 1;
		$notification->broadcast = 0;
		$notification->is_auto = 1;
		$notification->created_by = "system";
		$notification->category = 2;
		$notification->save();
		*/
		$notification = new Notification([
			'title'			=> 'You\'ve reserved an event []',
			'description'	=> '',
		]);
		
		return redirect()->route('event.index')->with('alert', 'Event reserved successfully!');
    }
    
	public function select_tab(Request $request)
	{
	  if(Session::get('authority') == "admin")
	  {
	  $html = '';
	  $code = $request->get('code');
	  $query = $request->get('query');
	  $pid = \DB::table('programmes')
	  ->where('code',$code)
	  ->value('pid');
	  
	  if($pid!=null)
	  { 
		  if($query == 'past_event'){
			$data = \DB::table('events')->where('pid',$pid)->where('date','<',date('Y-m-d'))->get();
		  }elseif($query == 'ongoing_event'){
			$data = \DB::table('events')->where('pid',$pid)->where('date','>=',date('Y-m-d'))->get();
		  }elseif($query == 'all_event'){
			$data = \DB::table('events')->where('pid',$pid)->get();
		  }
	  }
	  else
	  {
		  if($query == 'past_event'){
			$data = \DB::table('events')->where('date','<',date('Y-m-d'))->get();
		  }elseif($query == 'ongoing_event'){
			$data = \DB::table('events')->where('date','>=',date('Y-m-d'))->get();
		  }elseif($query == 'all_event'){
			$data = \DB::table('events')->get();
		  }
	  }
	  $total_row = $data->count();
	  if($total_row > 0)
	  {
		$html ='<div>
		<table>
			<tr>
				<th>Event Name</th>
				<th>Date</th>
				<th>Time</th>
				<th>Venue</th>
				<th>Details</th>
			</tr>';
			foreach($data as $row)
			{
				$html .= '
					<tr>
						<td>'.$row->name.'</td>
						<td>'.$row->date.'</td>
						<td>'.date('h:i a',strtotime($row->start_time)).' - '.date('h:i a',strtotime($row->end_time)).'</td>
						<td>'.$row->venue.'</td>
						<td>
							<a href="'.route("event.show-detail", $row->eid).'">
								<button type="button" class="btn btn-primary">See More</button>
							</a>
						</td>
					</tr>
				';
			}
			$html .= '</table></div>';
		}
		else
		{
		   $html = '<h1>No Available Event</h1>';
		}
		return $html;
	}
	elseif(Session::get('authority') == "volunteer")
	{
		$html = '';
		$vid = Session::get('user_id');
		$code = $request->get('code');
	    $query = $request->get('query');
		$pid = \DB::table('programmes')->where('code',$code)->value('pid');
		  
	  if($pid!=null)
	  {
		  if($query == 'reserved_event')
		  {
		  $data = \DB::table('volunteer_events')
		  ->join('events','volunteer_events.eid','=','events.eid')
		  ->where('events.pid',$pid)
		  ->where('volunteer_events.vid',Session::get('user_id'))
		  ->where('date','>=',date('Y-m-d'))
		  ->get();
		  }
		  elseif($query == 'available_event'){
			$reserved_eids = VolunteerEvent::where('vid', $vid)->pluck('eid');
			$data = \DB::table('events')
			->where('pid',$pid)->where('date','>=',date('Y-m-d'))
			->whereNotIn('eid', $reserved_eids)
			->get();
		 }
		  elseif($query == "past_events")
		  {
			  $data = \DB::table('volunteer_events')
			  ->join('events','volunteer_events.eid','=','events.eid')
			  ->where('volunteer_events.vid',Session::get('user_id'))
			  ->where('pid',$pid)
			  ->get();
		  }
	  }
	  else
	  {
		  if($query == 'reserved_event')
		  {
		  $data = \DB::table('volunteer_events')
		  ->join('events','volunteer_events.eid','=','events.eid')
		  ->where('volunteer_events.vid',Session::get('user_id'))
		  ->where('date','>=',date('Y-m-d'))
		  ->get();
		  }elseif($query == 'available_event'){
			$reserved_eids = VolunteerEvent::where('vid', $vid)->pluck('eid');
			$data = \DB::table('events')->where('date','>=',date('Y-m-d'))
			->whereNotIn('eid', $reserved_eids)
			->get();
		  }
		  elseif($query == "past_events")
		  {
			  $data = \DB::table('volunteer_events')
			  ->join('events','volunteer_events.eid','=','events.eid')
			  ->where('volunteer_events.vid',Session::get('user_id'))
			  ->get();
		  }
	  }

		  $total_row = $data->count();
		  if($total_row > 0)
		  {
			$html ='<div>
			<table>
				<tr>
					<th>Event Name</th>
					<th>Date</th>
					<th>Time</th>
					<th>Venue</th>
					<th>Details</th>
				</tr>';
		   foreach($data as $row)
		   {
			$html .= '
				<tr>
					<td>'.$row->name.'</td>
					<td>'.$row->date.'</td>
					<td>'.date('h:i a',strtotime($row->start_time)).' - '.date('h:i a',strtotime($row->end_time)).'</td>
					<td>'.$row->venue.'</td>
					<td>
						<a href="'.route("event.show-detail", $row->eid).'">
							<button type="button" class="btn btn-primary">See More</button>
						</a>
				  </td>
				</tr>
			';
		   }
		   $html .='</table></div>';
		  }
		  else
		  {
		   $html = '<h1>No Available Event</h1>';
		  }
		  
		  return $html;
		 }
		else
			return [];
	}
}

