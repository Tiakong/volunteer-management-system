<?php

namespace App\Http\Controllers;

use App\Common;
use Illuminate\Http\Request;
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

class MainController extends Controller
{	

    public function award(Request $request){
        $volunteer_serve_hour = \DB::table('volunteers')->where('vid',\Session::get('user_id'))->value('acc_serve_hour');
        $volunteer_rank =\DB::table('award_histories')->where('vid',\Session::get('user_id'))->value('description');

        return view('award',[
            'volunteer_serve_hour' => $volunteer_serve_hour,
            'volunteer_rank' => $volunteer_rank
        ]);
    }
   
	public function index(Request $request)
	{

        $authority = $request->session()->get('authority');
        /******************Admin Data*****************/
        $programmes = Programme::all();
        $events = \DB::table('events')->where('date','>=',date('Y-m-d'))->get();
        foreach($programmes as $i => $programme){
            $number_of_events[$i] = count(\DB::table('events')->where('pid',$programme->pid)->get());
            $number_of_completed_events[$i] = count(\DB::table('events')->where('pid',$programme->pid)->where('date','<',date('Y-m-d'))->get());
            $number_of_ongoing_events[$i] = count(\DB::table('events')->where('pid',$programme->pid)->where('date','>=',date('Y-m-d'))->get());
        }

        $total_volunteers = Volunteer::all();
        $active_volunteer = 0;
        foreach($total_volunteers as $volunteer){
            if(((strtotime(date('Y-m-d'))-strtotime($volunteer->last_login))/86400)<100){
                $active_volunteer += 1;
            }
        }

        $lifetime_ranking = Volunteer::orderBy('acc_serve_hour','desc')->paginate(5);
        
        //find top 5 volunteer in volunteer_events table
        foreach($total_volunteers as $i => $volunteer){
            $number = \DB::table('volunteer_events')
            ->join('events','volunteer_events.eid','=','events.eid')
            ->where('volunteer_events.vid',$volunteer->vid)
            ->where('volunteer_events.status','present')
            ->where('events.date','>',date('Y-m-d',mktime(0,0,0,1,1,date("Y"))))
            ->where('events.date','<',date('Y-m-d',mktime(0,0,0,1,1,date("Y")+1)))
            ->sum('volunteer_events.serve_hour');
            $number_of_events_of_the_volunteer[$volunteer->name] = $number;
            arsort($number_of_events_of_the_volunteer);
            
            
        }

        foreach($number_of_events_of_the_volunteer as $name => $number){
            $occupation = \DB::table('volunteers')->where('name',$name)->value('occupation');
            $name_occupation[$name] = $occupation;
        }

        /***********************Volunteer Data*******************/
            $number_of_reserved_events = \DB::table('volunteer_events')
            ->join('events','volunteer_events.eid','=','events.eid')
            ->where('volunteer_events.vid',\Session::get('user_id'))
            ->where('volunteer_events.status','absent')
            ->where('events.date','>',date('Y-m-d',mktime(0,0,0,1,1,date("Y"))))
            ->where('events.date','<',date('Y-m-d',mktime(0,0,0,1,1,date("Y")+1)))
            ->count();

            $number_of_attended_events = \DB::table('volunteer_events')
            ->join('events','volunteer_events.eid','=','events.eid')
            ->where('volunteer_events.vid',\Session::get('user_id'))
            ->where('volunteer_events.status','present')
            ->count();

            $number_of_completed_events_annual = \DB::table('volunteer_events')
            ->join('events','volunteer_events.eid','=','events.eid')
            ->where('volunteer_events.vid',\Session::get('user_id'))
            ->where('volunteer_events.status','present')
            ->where('events.date','>',date('Y-m-d',mktime(0,0,0,1,1,date("Y"))))
            ->where('events.date','<',date('Y-m-d',mktime(0,0,0,1,1,date("Y")+1)))
            ->count();

            $lifetime_serve_hours = \DB::table('volunteers')
            ->where('vid',\Session::get('user_id'))
            ->value('acc_serve_hour');
        
            $annual_serve_hours = \DB::table('volunteer_events')
            ->join('events','volunteer_events.eid','=','events.eid')
            ->where('volunteer_events.vid',\Session::get('user_id'))
            ->where('volunteer_events.status','present')
            ->where('events.date','>',date('Y-m-d',mktime(0,0,0,1,1,date("Y"))))
            ->where('events.date','<',date('Y-m-d',mktime(0,0,0,1,1,date("Y")+1)))
            ->sum('volunteer_events.serve_hour');

            $volunteer_rank = \DB::table('award_histories')
            ->where('vid',\Session::get('user_id'))
            ->value('description');
        
        return view('/homepage',[
            'programmes' => $programmes,
            'events' => $events,
            'number_of_events' => $number_of_events,
            'number_of_completed_events' => $number_of_completed_events,
            'number_of_ongoing_events' => $number_of_ongoing_events,
            'total_volunteers' => $total_volunteers,
            'active_volunteers' => $active_volunteer,
            'lifetime_ranking' => $lifetime_ranking,
            'annual_ranking' => $number_of_events_of_the_volunteer,
            'number_of_reserved_events' => $number_of_reserved_events,
            'number_of_attended_events' => $number_of_attended_events,
            'annual_completed_events' => $number_of_completed_events_annual,
            'lifetime_serve_hours' => $lifetime_serve_hours,
            'annual_serve_hours' => $annual_serve_hours,
            'volunteer_rank' => $volunteer_rank,
            'authority'=> $authority,
            'name_occupation' => $name_occupation
        ]);
	}
	
}
