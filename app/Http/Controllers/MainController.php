<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
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
        $volunteer_serve_hour = \DB::table('volunteers')
		->where('vid',\Session::get('user_id'))
		->value('acc_serve_hour');
		
        $volunteer_rank =\DB::table('award_histories')
		->where('vid',\Session::get('user_id'))
		->value('description');

        return view('award',[
            'volunteer_serve_hour' => $volunteer_serve_hour,
            'volunteer_rank' => $volunteer_rank
        ]);
    }
   
	public function index(Request $request)
	{
        /******************Admin Data*****************/
        $programmes = Programme::all();
        $events = \DB::table('events')->where('date','>=',date('Y-m-d'))->get();
        foreach($programmes as $i => $programme){
            $number_of_events[$i] = count(\DB::table('events')->where('pid',$programme->pid)->get());
            $number_of_completed_events[$i] = count(\DB::table('events')->where('pid',$programme->pid)->where('date','<',date('Y-m-d'))->get());
            $number_of_ongoing_events[$i] = count(\DB::table('events')->where('pid',$programme->pid)->where('date','>=',date('Y-m-d'))->get());
        }

		//inactive volunteers
        $inactive_volunteer_count = count(Volunteer::where('last_active_date', '<', Carbon::now()->subDays(Common::$DAY_TO_CONSIDER_INACTIVE))
		->orderBy('last_active_date', 'asc')
		->get());
		
		//Number of volunteers in the database
		$volunteer_count = count(Volunteer::all());
		
		//Number of new volunteer registered this month
		$new_volunteer_this_month = count(Volunteer::whereMonth('created_at', '=', Carbon::today()->month)
		->get());

		//volunteers lifetime serve hour 
		$volunteer_acc_serve_hour = DB::table('volunteers as v')
		->select('v.*', DB::raw('sum(ve.serve_hour+vo.serve_hour) as total_serve_hour'))
		->join('volunteer_events as ve', 'v.vid', '=', 've.vid')
		->join('volunteer_officeworks as vo', 'v.vid', '=', 'vo.vid')
		->where('ve.status','present')
		->groupBy('v.vid')
		->orderBy('total_serve_hour', 'desc');
		
		$year = Carbon::now()->year;
		$eids = Event::where('date', '>=', $year.'-01-01')
		->where('date', '<=', $year.'-12-31')
		->pluck('eid');
		
		//volunteers annual serve hour 
		$volunteer_ann_serve_hour = $volunteer_acc_serve_hour->whereIn('ve.eid', $eids)->get();
		$volunteer_acc_serve_hour = $volunteer_acc_serve_hour->get();
		
		//next event
		$date = Event::whereDate('date', '>', Carbon::now()->format('Y-m-d'))
		->join('programmes', 'programmes.pid', '=', 'events.pid')
		->orderBy('date', 'asc')
		->first()
		->date;
		
		$next_events = Event::whereDate('date', '=', $date)
		->join('programmes as p', 'p.pid', '=', 'events.pid')
		->select('p.code', 'events.*')
		->orderBy('start_time')
		->get();
		
        /***********************Volunteer Data*******************/
        
		
        return view('/homepage',[
			"new_volunteer_this_month"	=>	$new_volunteer_this_month,
			"volunteer_count"			=>	$volunteer_count,
			"active_volunteer_count"	=>	$volunteer_count - $inactive_volunteer_count,
			"volunteer_acc_serve_hour"	=>	$volunteer_acc_serve_hour,
			"volunteer_ann_serve_hour"	=>	$volunteer_ann_serve_hour,
			"next_events"				=>	$next_events
        ]);
	}
	
}
