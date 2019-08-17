<?php

namespace App\Http\Controllers;
use App\Common;
use Illuminate\Http\Request;
use App\AdminAccount;
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
class Volunteer_eventController extends Controller
{
    //
    public function index($id)
    {
      if(Session::get('authority')!='admin'){
        return redirect('/');
      }
      $volunteers = \DB::table('volunteer_events as ve')
	  ->join('volunteers as v','v.vid','=','ve.vid')
	  ->where('eid',$id)
	  ->orderBy('v.name', 'asc')
	  ->select('ve.*', 'v.*', 've.remark as event_remark')
	  ->get();
	  
      $event = \DB::table('events')->where('eid',$id);
	  $serve_hour = $event->value('serve_hour');
	  $event_date = $event->value('date');

      return view('volunteer_event.index',[
        'volunteers' => $volunteers,
        'date' =>$event_date,
        'serve_hour' =>$serve_hour,
        'eid' =>$id
      ]);
    }

    public function create($id)
    {
      if(Session::get('authority')!='admin'){
        return redirect('/');
      }
	  
      $volunteers = \DB::table('volunteer_events as ve')
	  ->join('volunteers as v','v.vid','=','ve.vid')
	  ->where('eid',$id)
	  ->orderBy('v.name', 'asc')
	  ->select('ve.*', 'v.*', 've.remark as event_remark')
	  ->get();
	  
      $event = \DB::table('events')->where('eid',$id);
	  $serve_hour = $event->value('serve_hour');
	  $event_date = $event->value('date');

      return view('volunteer_event.create',[
		'volunteers'	=> $volunteers,
        'eid' => $id,
        'date' =>$event_date,
		'serve_hour' => $serve_hour
      ]);
    }

    public function update(Request $request, $id)
    {
        if(Session::get('authority')!='admin'){
            return redirect('/');
        }
		$volunteer_list = get_object_vars(json_decode($request->get('volunteerList')));
		$vids = array_keys((array)$volunteer_list);
		$vs = VolunteerEvent::where('eid', $id)
		->whereIn('vid', $vids)
		->get();
		
		
		foreach($vs as $v)
		{
			$val = $volunteer_list[$v->vid];
			$v->serve_hour = $val->serve_hour;
			$v->remark = $val->event_remark;
			if($val->status == ""){
				$v->status = "pending";
			}
			else{
				$v->status = $val->status;
			}
			$v->save();
		}
		
		return Volunteer_eventController::index($id);
    }

    public function confirm(Request $request,$id)
    {
      $event =\DB::table('events')->where('eid',$id)->first();
      $volunteer_total_serve_hour = \DB::table('volunteers')->where('vid',$request->vid)->value('acc_serve_hour');
      $volunteer_total_serve_hour += $event->serve_hour;
      \DB::table('volunteer_events')->where('vid',$request->vid)->where('eid',$id)->update(['status' => 'present','serve_hour' => $event->serve_hour]);
      \DB::table('volunteers')->where('vid',$request->vid)->update(['acc_serve_hour' => $volunteer_total_serve_hour]);

      foreach(Common::$ranks as $hours => $rank){
        if($volunteer_total_serve_hour >= $hours){
          $awarded_volunteer = \DB::table('award_histories')->where('vid',$request->vid)->first();
          if($awarded_volunteer != null){
            \DB::table('award_histories')->where('vid',$awarded_volunteer->vid)->update(['description' => $rank]);
            break;
          }else{
            $new_award = new AwardHistory;
            $new_award->vid = $request->vid;
            $new_award->description = $rank;
            $new_award->save();
            break;
          }
        }
      }
      return redirect()->route('volunteer_event.index',['id' => $id])->with('alert', 'Attendance confirmed!');
    }

    public function destroy(Request $request)
    {
		$eid = $request->get('eid');
		$vid = $request->get('vid');
		
		//Check existance
		$ve = VolunteerEvent::where('eid', $eid)->where('vid', $vid)->first();
		if($ve == null)
			return null;
		$ve->delete();
		
		return $vid;
    }

    public function action(Request $request){
        $html = '';
        $query = $request->get('query');
        if($query == ''){
			return [];
		}
		
		$data = \DB::table('volunteers')
		->orWhere('nric','like','%'.$query.'%')
		->orWhere('name','like','%'.$query.'%')
		->get();
			
          foreach($data as $index => $row){ 
            $html .= '
            <tr>
				<td>'.$row->name.'</td>
				<td id="ic">'.$row->nric.'</td>
				<td>'.$row->gender.'</td>
				<td>'.$row->contact_no.'</td>
				<td><input type="text" name="serve_hour" /></td>
				<td><input type="text" name="remark" /></td>
				<td>'.$row->email.'</td>
				<td>
					<form method="post" class="myForm">
					  <input type="text" name="ic" value="'.$row->nric.'" hidden>
					   <input type="submit" value="Select" class="btn btn-primary">
					</form>
				</td>
            </tr>
            ';
          }
        
		
        $output = array(
        'table_data'  => $html,
        'total_data'  => $total_row,
        );
        return $output;
    }
	
	public function add(Request $request)
	{
		$eid = $request->get('eid');
		$vid = $request->get('vid');
		
		//check if the volunteer already exists in the event
		$ve = VolunteerEvent::where('eid', $eid)->where('vid', $vid)->first();
		if($ve != null)
			return null;
		
		$ve = new VolunteerEvent([
			'eid'	=>	$eid,
			'vid'	=>	$vid,
			'status'=>	'',
			'remark'=>	'',
			'serve_hour'=>	0
		]);
		$ve->save();
		$v = Volunteer::where('vid', $vid)->first();
		$html = "
		<tr id='tr-".$v->vid."'>
            <td>".$v->id."</td>
            <td>".$v->name."</td>
            <td class='text-center'>".$v->gender."</td>
            <td>".$v->contact_no."</td>
            <td>".$v->email."</td>
            <td class='text-center'>
				<input type='text' id='serve_hour' class='form-control' name='serve_hour|".$v->vid."' value='".$v->serve_hour."' />
			</td>
			<td>
				<input type='text' class='form-control' name='remark|".$v->vid."' value='".$v->event_remark."' />
			</td>
			<td class='text-center' onclick='set(this)'>
				<input type='checkbox' name='status|".$v->vid."' readonly ".($v->status=="present"?'checked':'').">
			</td>
			<td>
				<button type='button' style='padding:0px 3px;' class='btn btn-danger' onclick=\"remove('".$v->vid."')\"><i class='fa fa-close'></i></button>
			</td>
		</tr>
		";
		return $html;
	}
}
