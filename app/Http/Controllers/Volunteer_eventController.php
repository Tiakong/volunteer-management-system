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
      $volunteers = \DB::table('volunteer_events')->join('volunteers','volunteers.vid','=','volunteer_events.vid')->where('eid',$id)->get();
      $event_serve_hour = \DB::table('events')->where('eid',$id)->value('serve_hour');
      $event_date = \DB::table('events')->where('eid',$id)->value('date');

      return view('volunteer_event.index',[
        'volunteers' => $volunteers,
        'serve_hour' => $event_serve_hour,
        'date' =>$event_date,
        'eid' =>$id
      ]);
    }

    public function create($id)
    {
      if(Session::get('authority')!='admin'){
        return redirect('/');
      }
      return view('volunteer_event.create',[
        'eid' => $id
      ]);
    }

    public function update(Request $request,$id)
    {
      $volunteer = \DB::table('volunteers')->where('nric',$request->ic)->first();
      $event =\DB::table('events')->where('eid',$id)->first();
      $existed_volunteer = \DB::table('volunteer_events')->where('vid',$volunteer->vid)->where('eid',$event->eid)->get();
      if(count($existed_volunteer)>0){
        return redirect()->back()->with('alert', 'This volunteer has registered the event before! Please select another volunteer');
      }
      else{
        \DB::table('volunteer_events')->insert(
          ['vid' => $volunteer->vid, 'eid' => $event->eid, 'status' => 'present', 'remark' => 'no','serve_hour' => $event->serve_hour]
      );
       return $this->index($id)->with('alert', 'Registered successfully!');
      }
    }

    public function confirm(Request $request,$id)
    {
      $event =\DB::table('events')->where('eid',$id)->first();
      $volunteer_total_serve_hour = \DB::table('volunteers')->where('vid',$request->vid)->value('acc_serve_hour');
      $volunteer_total_serve_hour += $request->serve_hour;
      \DB::table('volunteer_events')->where('vid',$request->vid)->where('eid',$id)->update(['status' => 'present','serve_hour' => $request->serve_hour]);
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

    public function destroy(Request $request,$id)
    {
      \DB::table('volunteer_events')->where('vid',$request->vid)->where('eid',$id)->update(['status' => 'absent']);
      return redirect()->route('volunteer_event.index',['id' => $id])->with('alert', 'Attendance confirmed!');
    }

    public function action(Request $request){
     if($request->ajax()){
        $output = '';
        $query = $request->get('query');
        if($query != ''){
          $data = \DB::table('volunteers')->where('nric','like','%'.$query.'%')->orWhere('name','like','%'.$query.'%')->get();
          }

        $total_row = $data->count();

        if($total_row > 0){
          foreach($data as $index => $row){ 
            $output .= '

            <tr>
            
            <td>'.$row->name.'</td>
            <td id="ic">'.$row->nric.'</td>
            <td>'.$row->gender.'</td>
            <td>'.$row->contact_no.'</td>
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
        }
        else{
          $output = '
          <tr>
            <td align="center" colspan="5">No Data Found</td>
          </tr>
          ';
        }
        $data = array(
        'table_data'  => $output,
        'total_data'  => $total_row,
        );

        echo json_encode($data);
      }
    }
}
