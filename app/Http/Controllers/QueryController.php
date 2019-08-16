<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Common;

use Maatwebsite\Excel\Facades\Excel;

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
use App\DataExport;

class QueryController extends Controller
{
	public function searchVolunteerByName(Request $request)
	{
		$name = $request->get('name');
		if($name == "") return [];
		$volunteers = Volunteer::where('name', 'like', '%' . $name . '%')
		->select('id', 'name','email','contact_no','race','last_active_date','vid')
		->get();

		return $volunteers;
	}
	
	public function searchVolunteerByCriteria(Request $request)
	{
		$ss = DB::table("skillsets");
		foreach($request->all() as $key => $value)
		{
			try
			{
				//because $request is shared among searchByName and searchByProgramme, so $value might become the name of volunteer
				if(intval($value))
				{
					$ss = $ss->where($key , '>', 0);
				}
			}catch(\Exception $e)
			{
				
			}
		}
		$vids = $ss->pluck('vid');
		$volunteers = Volunteer::whereIn('vid', $vids)->get();
		return $volunteers;
	}
	
	public function searchVolunteerByProgramme(Request $request)
	{
		
		$results = [];
		//Get the interested programme
		$code = $request->get('code');
		if($code == "") return [];
		$pid = Programme::where('code', $code)
		->first()->pid;
		
		$vids = InterestedProgramme::where('pid', $pid)
		->pluck('vid');
		
		$results['interested'] = Volunteer::whereIn('vid', $vids)->get();
		
		//Get the past experience of this programme
		$results['experience'] = DB::table('volunteer_events as ve')
		->join('events as e', 'e.eid', '=', 've.eid')
		->join('programmes as p', 'e.pid', '=', 'p.pid')
		->join('volunteers as v', 'v.vid', '=', 've.vid')
		->where('p.pid', $pid)
		->groupBy('v.vid')
		->select('v.vid', 'v.id', 'v.name', 'v.contact_no', 'v.email', \DB::raw('count(*) as attempts'))
		->orderBy('attempts', 'desc')
		->get();
		
		return $results;
	}
	
	public function combineSearchQuery(Request $request){
		
		//Volunteer
		$v = QueryController::searchVolunteerByName($request);
		
		//Volunteer that met the criteria
		$vc = QueryController::searchVolunteerByCriteria($request);
		
		//Volunteer that interest in programme
		$vp = QueryController::searchVolunteerByProgramme($request);
		
		return [
			'v'=>$v,
			'vc'=>$vc,
			'vp'=>$vp
		];
	}
	
	public function VO_getVolunteers(Request $request)
	{
		$id = $request->get('oid');
		
		$volunteersId = DB::table('volunteer_officeworks as vo')
		->where('oid',$id)
		->pluck('vo.vid');
		
		$volunteers = DB::table('volunteer_officeworks as vo')
		->where('oid',$id)
		->join('volunteers as v', 'v.vid', '=', 'vo.vid')
		->whereIn('vo.vid', $volunteersId)
		->select('v.vid','v.id','v.name','vo.remark','vo.serve_hour')
		->get();
		
		return $volunteers;
	}
	
	public function exportData(Request $request)
	{
		$case			= $request->get('case');
		$programme_code	= $request->get('programme_code');
		$event_id 		= $request->get('event_id');
		$volunteer_name	= $request->get('volunteer_name');
		$dateFrom 		= $request->get('date_from');
		$dateTo			= $request->get('date_to');
		
		$finalOutput = [];
		$finalOutput['status'] = 'success';
		
		try
		{
			if($volunteer_name)
			{
				$volunteer = Volunteer::where('name', $volunteer_name);
				if($volunteer) $finalOutput['volunteer'] = $volunteer->first();
			}
			
			if($programme_code)
			{
				$programme = Programme::where('code', $programme_code)->select('pid', 'code', 'name');
				if($programme) $finalOutput['programme'] = $programme->first();
				
			}
			
			$events = DB::table('events as e')
			->select('eid','name','date');
			if($dateFrom) $event = $events->where('date', '>=', $dateFrom);
			if($dateTo) $events = $events->where('date', '<=', $dateTo);
			if($event_id) {
				$event = $events->where('eid', $event_id)->first();
				$finalOutput['event'] = $event;
			}
			$eids = $events->pluck('eid');
			
			//1. Get attendance list for upcoming event
			/*
			Sample output:
			| programme name | ....
			| programme code | STEP |
			| event name	 | ....
			| no. of participants | 49 |
			| t shirt | S 10 | M 25 | L 7 | XL 7 |
			| id       | name | gender | t shirt size | status | remark               |
			| ccv00017 | .... | F      | S            |        | Vegetarian           |
			| ccv00102 | .... | F      | L            |        | Allergic to seafood  |
			| ccv00043 | .... | M      | XL           |        |                      |
			| ccv00056 | .... | M      | M            |        |                      |
			*/
			switch($case)
			{
				case 1:
				$finalOutput['case'] = 1;
				$eid = $finalOutput['event']->eid;
				$vids = VolunteerEvent::where('eid', $eid)
				->pluck('vid');
				$v = DB::table('volunteers as v')
				->join('volunteer_events as ve', 've.vid', '=', 'v.vid')
				->where('ve.eid', $eid)
				->whereIn('v.vid', $vids)
				->select('v.id', 'v.name', 'v.remark', 'v.t_shirt_size', 'v.contact_no', 'v.gender', 've.status', 've.eid');
				$finalOutput['volunteer'] = $v->get();
				
				$tss = $v->select(DB::raw('t_shirt_size, count(*) as v_count'))->groupBy('t_shirt_size')->pluck('v_count','t_shirt_size');
				$finalOutput['tss'] = $tss;
				
				$col = 8;
				$labelSpanSize = 3;
				$descSpanSize = $col - $labelSpanSize;
				
				$html = '
				<col width="5%">
				<col width="10%">
				<col width="30%">
				<col width="15%">
				<col width="5%">
				<col width="5%">
				<col width="5%">
				<col width="25%">
				<tr>
					<th colspan='.$labelSpanSize.'>Programme</th>
					<td colspan='.$descSpanSize.'>('.$finalOutput['programme']->code.') '.$finalOutput['programme']->name.'</td>
				</tr>
				<tr>
					<th colspan='.$labelSpanSize.'>Event Name</th>
					<td colspan='.$descSpanSize.'>'.$finalOutput['event']->name.'</td>
				</tr>
				<tr>
					<th colspan='.$labelSpanSize.'>Date</th>
					<td colspan='.$descSpanSize.'>'.Carbon::parse($finalOutput['event']->date)->format("d/m/Y").'</td>
				</tr>
				<tr>
					<th colspan='.$labelSpanSize.'>No. of volunteers</th>
					<td colspan='.$descSpanSize.'>'.count($finalOutput["volunteer"]).'</td>
				</tr>
				<tr>
					<th colspan='.$labelSpanSize.'>T Shirt Summary</th>
					<td>S '.(isset($tss['S'])?$tss['S']:0).'</td>
					<td>M '.(isset($tss['M'])?$tss['M']:0).'</td>
					<td>L '.(isset($tss['L'])?$tss['L']:0).'</td>
					<td>XL '.(isset($tss['XL'])?$tss['XL']:0).'</td>
				</tr>
				<tr>
					<th>No.</th>
					<th>ID</th>
					<th>Name</th>
					<th>Contact no.</th>
					<th>Gender</th>
					<th>Size</th>
					<th>Remark</th>
					<th>Status</th>
				</tr>
				';
				//Only display the first 10
				foreach((count($finalOutput['volunteer'])<10?$finalOutput['volunteer']:array_slice($finalOutput['volunteer'], 0, 10)) as $i=>$v)
				{
					$html .= "
					<tr>
						<td class='text-center'>".($i+1)."</td>
						<td>".($v->id)."</td>
						<td>".($v->name)."</td>
						<td>".($v->contact_no)."</td>
						<td class='text-center'>".($v->gender)."</td>
						<td class='text-center'>".($v->t_shirt_size)."</td>
						<td>".($v->remark)."</td>
						<td class='text-center'>".($v->status)."</td>
					</tr>
					";
				}
				$finalOutput['html'] = $html;
				$finalOutput['header'] = [
					"Programme,"."(".$finalOutput['programme']->code.") ".$finalOutput['programme']->name,
					"Event name,".$finalOutput['event']->name,
					"Date,".Carbon::parse($finalOutput['event']->date)->format("d/m/Y"),
					"No. of volunteers,".count($finalOutput["volunteer"]),
					"T Shirt Summary,[S ".(isset($tss['S'])?$tss['S']:0).']  [M '.(isset($tss['M'])?$tss['M']:0).']  [L '.(isset($tss['L'])?$tss['L']:0).']  [XL '.(isset($tss['XL'])?$tss['XL']:0).']'			
				];
				
				$finalOutput['body'] = [
					"No.,ID,Name,Contact no.,Gender,Size,Remark,Status"
				];
				foreach($finalOutput['volunteer'] as $i => $v)
				{
					$element = ($i+1).','.
					$v->id.','.
					$v->name.','.
					$v->contact_no.','.
					$v->gender.','.
					$v->t_shirt_size.','.
					$v->remark.','.
					$v->status;
					array_push($finalOutput['body'], $element);
				}
				
				break;
			
			//2. Show the list of events a volunteer registered before
			/*
			Sample output:
			| Yee Hong Weng    | ccv00001 |
			| Total serve hour | 10.0     |
			| programme code | event name | date       | serve_hour | status | remark                      |
			|       MAD      | ....        | 2019-04-01 | 3.0        |   P    |                             |
			|       STEP     | ....        | 2019-04-02 | 3.0        |   P    |                             |
			|       STEP     | ....        | 2019-08-13 | 4.0        |   P    |                             |
			|       YER      | ....        | 2019-03-05 | 0.0        |   A    | Absent because of emergency |
			*/
			
			case 2: case 4:
				$finalOutput['case'] = 2;
				$v = $finalOutput['volunteer'];
				
				$pne = $events
				->join('volunteer_events as ve', 'e.eid', '=', 've.eid')
				->join('programmes as p', 'e.pid', '=', 'p.pid')
				->where('vid', $v->vid)
				->select('ve.serve_hour', 've.remark', 've.status', 'e.eid', 'e.name', 'e.date', 'p.name', 'p.code')
				->orderBy('p.code', 'asc')
				->orderBy('e.date', 'asc');
				
				$total = $pne->sum('ve.serve_hour');
				
				$finalOutput['total_serve_hour'] = $total;
				$finalOutput['pne'] = $pne->get();
				
				$headerSpan = 2;
				$bodySpan = 4;
				
				$html = "
				<col width='15%'>
				<col width='25%'>
				<col width='15%'>
				<col width='10%'>
				<col width='5%'>
				<col width='30%'>
				<tr>
					<th colspan=".$headerSpan.">Volunteer ID</th>
					<td colspan=".$bodySpan.">".$v->id."</td>
				</tr>
				<tr>
					<th colspan=".$headerSpan.">Volunteer Name</th>
					<td colspan=".$bodySpan.">".$v->name."</td>
				</tr>
				<tr>
					<th colspan=".$headerSpan.">Total Serve Hour In Event</th>
					<td colspan=".$bodySpan.">".$total."</td>
				</tr>
				<tr>
					<th>Programme Code</th>
					<th>Event Name</th>
					<th>Date</th>
					<th>Serve hour</th>
					<th>Status</th>
					<th>Remark</td>
				</tr>
				";
				
				//Only display the first 10
				foreach((count($finalOutput['pne'])<10?$finalOutput['pne']:array_slice($finalOutput['pne'], 0, 10)) as $i=>$pne)
				{
					$html .= "
					<tr>
						<td class='text-center'>".$pne->code."</td>
						<td>".$pne->name."</td>
						<td>".Carbon::parse($pne->date)->format("d/m/Y")."</td>
						<td class='text-center'>".$pne->serve_hour."</td>
						<td class='text-center'>".$pne->status."</td>
						<td>".$pne->remark."</td>
					</tr>
					";
				}
				
				$finalOutput['html'] = $html;
				
				$finalOutput['header'] = [
					"Volunteer ID,".$finalOutput['volunteer']->id,
					"Volunteer Name,".$finalOutput['volunteer']->name,
					"Total Serve Hour (Event only),".$total
				];
				
				$finalOutput['body'] = [
					"Programme code,Event name,Date,Serve hour,Remark,Status"
				];
				
				foreach($finalOutput['pne'] as $i => $pne)
				{
					$text = $pne->code.','.
					$pne->name.','.
					Carbon::parse($pne->date)->format("d/m/Y").','.
					$pne->serve_hour.','.
					$pne->remark.','.
					$pne->status;
					array_push($finalOutput['body'], $text);
				}
				
				break;
			
			//3. Show the list of events under a specific programme a volunteer registered before
			/*
			Sample output:
			
			| Yee Hong Weng    | ccv00001          |
			| programme code   | MAD               |
			| programme name   | Make A Difference |
			| Total serve hour | 10.0              |
			| event title | date       | serve_hour | status | remark                      |
			| ....        | 2019-04-01 | 3.0        |   P    |                             |
			| ....        | 2019-04-02 | 3.0        |   P    |                             |
			| ....        | 2019-04-03 | 4.0        |   P    |                             |
			*/
			
			case 3: case 5:
				$finalOutput['case'] = 3;
				$v = $finalOutput['volunteer'];
				$p = $finalOutput['programme'];
				
				$ve = $events
				->join('volunteer_events as ve', 'e.eid', '=', 've.eid')
				->where('vid', $v->vid)
				->where('e.pid', $p->pid)
				->select('ve.serve_hour', 've.remark', 've.status', 'e.eid', 'e.name', 'e.date');
				
				$total = $ve->sum('ve.serve_hour');
				
				$finalOutput['total_serve_hour'] = $total;
				$finalOutput['event'] = $ve->get();
				
				$headerSpan = 1;
				$bodySpan = 4;
				
				$html = "
				<col width='40%'>
				<col width='20%'>
				<col width='10%'>
				<col width='15%'>
				<col width='15%'>
				<tr>
					<th colspan=".$headerSpan.">Volunteer ID</th>
					<td colspan=".$bodySpan.">".$v->id."</td>
				</tr>
				<tr>
					<th colspan=".$headerSpan.">Volunteer Name</th>
					<td colspan=".$bodySpan.">".$v->name."</td>
				</tr>
				<tr>
					<th colspan=".$headerSpan.">Programme</th>
					<td colspan=".$bodySpan."> (".$p->code.") ".$p->name."</td>
				</tr>
				<tr>
					<th colspan=".$headerSpan.">Total Serve Hour</th>
					<td colspan=".$bodySpan.">".$total."</td>
				</tr>
				<tr>
					<th>Event Name</th>
					<th>Date</th>
					<th>Serve hour</th>
					<th>Remark</th>
					<th>Status</th>
				</tr>
				";
				
				//Only display the first 10
				foreach((count($finalOutput['event'])<10?$finalOutput['event']:array_slice($finalOutput['event'], 0, 10)) as $i=>$e)
				{
					$html .= "
					<tr>
						<td>".$e->name."</td>
						<td>".Carbon::parse($e->date)->format("d/m/Y")."</td>
						<td>".$e->serve_hour."</td>
						<td>".$e->remark."</td>
						<td>".$e->status."</td>
					</tr>
					";
				}
				
				$finalOutput['html'] = $html;
				
				$finalOutput['header'] = [
					"Volunteer ID,".$finalOutput['volunteer']->id,
					"Volunteer Name,".$finalOutput['volunteer']->name,
					"Total Serve Hour (Event only),".$total
				];
				
				$finalOutput['body'] = [
					"Event name,Date,Serve hour,Remark,Status"
				];
				
				foreach($finalOutput['event'] as $i => $e)
				{
					$text = $e->name.','.
					Carbon::parse($e->date)->format("d/m/Y").','.
					$e->serve_hour.','.
					$e->remark.','.
					$e->status;
					array_push($finalOutput['body'], $text);
				}
				break;
				
			//6. Show the list of inactive volunteer
			/*
			Sample output:
			
			| ID       | Name              | Contact Number | Last login | No. of days inactive |
			| ccv00001 | Yee Hong Weng     | 011-1231231    | 2019-07-10 | 102                  |
			| ccv00002 | Ammy Lau Chen Wen | 012-1234567    | 2019-07-10 | 102                  |
			*/
				case 6:
				$volunteer = Volunteer::where('last_active_date', '<', Carbon::now()->subDays(0))
				->orderBy('last_active_date', 'asc')
				->get();
				
				$finalOutput['volunteer'] = $volunteer;
				
				$html = "
				<tr>
					<th>No of inactive volunteer</th>
					<td>".count($volunteer)."</td>
				</tr>
				<tr>
					<td>ID</td>
					<td>Name</td>
					<td>Contact Number</td>
					<td>Last Active Date</td>
					<td>No of days inactive</td>
				</tr>
				";
				//Only display the first 10
				foreach((count($volunteer)<10?$volunteer:array_slice($volunteer, 0, 10)) as $v)
				{
					$datediff = Carbon::parse($v->last_active_date)
					->diffInDays(Carbon::now());
					$html .= "
					<tr>
						<td>".$v->id."</td>
						<td>".$v->name."</td>
						<td>".$v->contact_no."</td>
						<td>".Carbon::parse($v->last_active_date)->format("d/m/Y")."</td>
						<td>".$datediff."</td>
					</tr>
					";
				}
				$finalOutput['html'] = $html;
				
				$finalOutput['header'] = [
					"No of inactive volunteer,".count($volunteer),
				];
				
				$finalOutput['body'] = [
					"ID,Name,Contact no.,Last active day,No. of days inactive"
				];
				
				foreach($finalOutput['volunteer'] as $i => $v)
				{
					$datediff = Carbon::parse($v->last_active_date)
					->diffInDays(Carbon::now());
					$text = $v->id.','.
					$v->name.','.
					$v->contact_no.','.
					Carbon::parse($v->last_active_date)->format("d/m/Y").','.
					$datediff;
					array_push($finalOutput['body'], $text);
				}
				break;
				
				//7. Show the list of most active volunteer
			/*
			Sample output:
			
			| ID       | Name              | Contact Number | Total serve hour |
			| ccv00001 | Yee Hong Weng     | 011-1231231    | 241.0            |
			| ccv00002 | Ammy Lau Chen Wen | 012-1234567    | 223.0            |
			
			*/
				case 7: case 8:
				
				$volunteers = DB::table('volunteers as v')
				->select('v.*', DB::raw('sum(ve.serve_hour+vo.serve_hour) as total_serve_hour'))
				->join('volunteer_events as ve', 'v.vid', '=', 've.vid')
				->join('volunteer_officeworks as vo', 'v.vid', '=', 'vo.vid')
				->groupBy('v.vid')
				->orderBy('total_serve_hour', 'desc');
				
				//Only show the most active volunteer in current year.
				if($case==8)
				{
					$year= Carbon::now()->year;
					$eids = Event::where('date', '>=', $year.'-01-01')
					->where('date', '<=', $year.'-12-31')
					->pluck('eid');
					$volunteers = $volunteers->whereIn('ve.eid', $eids);
				}
				
				$volunteers = $volunteers->get();
				
				$finalOutput['volunteer'] = $volunteers;
				
				$html = "
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Contact Number</th>
					<th>Total serve hour</td>
				</tr>
				";
				//Only display the first 10
				foreach((count($volunteers)<10?$volunteers:array_slice($volunteers, 0, 10)) as $v)
				{
					$html .= "
					<tr>
						<td>".$v->id."</td>
						<td>".$v->name."</td>
						<td>".$v->contact_no."</td>
						<td>".$v->total_serve_hour."</td>
					</tr>
					";
				}
				
				$finalOutput['html'] = $html;
				
				$finalOutput['header'] = [];
				
				$finalOutput['body'] = [
					"ID,Name,Contact no.,Total serve hour"
				];
				
				foreach($finalOutput['volunteer'] as $i => $v)
				{
					$text = $v->id.','.
					$v->name.','.
					$v->contact_no.','.
					$v->total_serve_hour;
					array_push($finalOutput['body'], $text);
				}
				break;
			}
		}
		catch(\ModelNotFoundException $e)
		{
			$finalOutput['status'] = 'invalid';
		}
		catch(\Exception $e)
		{
			$finalOutput['status'] = 'fail';
		}
		finally
		{
			return $finalOutput;
		}
	}
	
	public function exportDataGuidance(Request $request)
	{
		$index = $request->get('index');
		return Common::$guidanceJson[$index];
	}
	
	public function getEvents(Request $request)
	{
		$pcode 		= $request->get('code');
		$dateFrom 	= $request->get('date_from');
		$dateTo 	= $request->get('date_to');
		
		$pid = Programme::where('code', $pcode)->select('pid')->first()->pid;
		
		$events = Event::where('pid', $pid)->select('eid', 'name');

		if($dateFrom)
			$events = $events->where('date', '>=', $dateFrom);
		if($dateTo)
			$events = $events->where('date', '<=', $dateTo);
		
		return $events->orderBy('created_at', 'desc')->get();
	}
	
	public function getProgrammes(Request $request)
	{
		$code = $request->get('code');
		$programme = Programme::select('pid', 'code', 'name');
		
		if($code)
			$programme = $programme->where('code', $code);
		return $programme->get();
	}
	
}
