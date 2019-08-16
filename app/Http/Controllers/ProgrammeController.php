<?php

namespace App\Http\Controllers;

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
use App\ProgrammeImage;
use App\VolunteerEvent;
use App\InterestedProgramme;
use App\VolunteerNotification;
use App\VolunteerOfficework;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use File;	




class ProgrammeController extends Controller
{

	public function index()
	{
		$Programme = Programme::orderBy('name','asc')->get();
		return view('programme.index', [
			'programme' => $Programme,
		]);
	}
	

	public function create()
	{
		$Programme = new Programme();
		return view('programme.create',[
			'programme' => $Programme,
		]);
	}

	public function store(Request $request)
	{
		//===========================_//
		//       Validate Data        //
		//===========================///
		$validatedData = $request->validate([
			'name' => 'required|unique:programmes,name',
			'code' => 'required|unique:programmes,code', 
			'supporting_partner_image.*' => 'nullable|image|mimes:jpeg,jpg,png,gif',
		  ]);

		//===========================_//
		//  Save Image into Folder    //
		//===========================///
		if($request->hasFile('supporting_partner_image'))
		{
				$fileNameWithExt = $request->file('supporting_partner_image');
				foreach($fileNameWithExt as $fileNameWithExt)
				{
					$fileNaming = $fileNameWithExt->getClientOriginalName();
					$filename = pathinfo($fileNaming,PATHINFO_FILENAME);
					$extension = $fileNameWithExt->guessClientExtension();
					$fileNameToStore = $filename.'_'.time().'.'.$extension;
					$path = $fileNameWithExt->storeAs('public/cover_image',$fileNameToStore);
				}

		}
		//===========================_//
		//        Save Programme      //
		//===========================///
			$Programme = new Programme();
			$Programme->fill($request->all());
			$Programme->save();

		//===========================_//
		//  Retrieve Programme Id    //
		//===========================///
			$Programme_pid = Programme::where('name',$Programme->name)->first();

		//===========================_//
		//  Save Image into database  //
		//===========================///
			$fileName_array = $request->file('supporting_partner_image');
			if($fileName_array != null){
				foreach($fileName_array as $Image_array)
				{
					$Image_Naming = $Image_array->getClientOriginalName();
					$Image_partialname = pathinfo($Image_Naming,PATHINFO_FILENAME);
					$Image_extension = $Image_array->guessClientExtension();
					$Image_finalname = $Image_partialname.'_'.time().'.'.$Image_extension;

					$ProgrammeImage = new ProgrammeImage();
					$ProgrammeImage->filename = $Image_finalname;
					$ProgrammeImage->pid = $Programme_pid->pid;
					$ProgrammeImage->save();
				}
			}

			//===========================_//
			//      Send Notification    //
			//===========================///
			$notification = new Notification;
			$notification->title = 'New Available <'.$request->name.'> Programme';
			$notification->description = 'A new programme named: <'.$request->name.'> is available now!. Everyone is welcome to take part in this programme.';
			$notification->for_volunteer = 1;
			$notification->for_admin = 0;
			$notification->broadcast = 1;
			$notification->is_auto = 1;
			$notification->created_by = $request->created_by;
			$notification->category = 2;
			$notification->save();

		return redirect()->route('programme.index')->with('alert', 'Programme Created Successfully!'); 
	}

	//Must present if want to show a web page
	 public function show(Request $request)
    {
				$Programme = Programme::find($request->pid);
				$ProgrammeImage = ProgrammeImage::where('pid',$request->pid)->get();
				if(!$Programme) throw new ModelNotFoundException;
				if(!$ProgrammeImage) throw new ModelNotFoundException;

				return view('programme.show',[
					'programme' => $Programme,
					'programmeImage' => $ProgrammeImage,
				]);
    }

	//Must present if edit is present
	 public function edit($id)
    {
			$Programme = Programme::find($id);
			$ProgrammeImage = ProgrammeImage::where('pid',$id)->get();
			if(!$Programme) throw new ModelNotFoundException;
			if(!$ProgrammeImage) throw new ModelNotFoundException;

			return view('programme.edit',[
				'programme' => $Programme,
				'programmeImage' => $ProgrammeImage,
			]);
    }

	//Must present if edit is present
    public function update(Request $request, $id)
    {
		//===========================_//
		//       Validate Data       //
		//===========================///
		$this->validate($request,array(
			'name' => "required|unique:programmes,name,$id,pid",
			'code' => "required|unique:programmes,code,$id,pid",
			'supporting_partner_image.*' => 'nullable|image|mimes:jpeg,jpg,png,gif',
		));

			//===========================_//
			//  Retrieve delete file name  //
			//===========================///
			$selectValue =  Input::get('delete_filename');
			
			$ProgrammeImage = ProgrammeImage::where('pid',$id)->get();
			
			//===========================_//
			//  Delete images in storage  //
			//  Delete images in database //
			//===========================///
			if($selectValue != null){
				foreach($ProgrammeImage as $Image)
				{
					foreach($selectValue as $selected_files)
					{
						
						if($selected_files==$Image->filename)
						{
							$result = Storage::disk('public')->delete('cover_image/'.$Image->filename);
							$Image->delete();
						}
					}
				}
		}

			//===========================_//
			//Save new image into storage //
			//===========================///
			if($request->hasFile('supporting_partner_image'))
		{
				$fileNameWithExt = $request->file('supporting_partner_image');
				foreach($fileNameWithExt as $fileNameWithExt)
				{
					$fileNaming = $fileNameWithExt->getClientOriginalName();
					$filename = pathinfo($fileNaming,PATHINFO_FILENAME);
					$extension = $fileNameWithExt->guessClientExtension();
					$fileNameToStore = $filename.'_'.time().'.'.$extension;
					$path = $fileNameWithExt->storeAs('public/cover_image',$fileNameToStore);
				}

		}

		//===========================_//
		//Save new image into database//
		//===========================///
		$fileName_array = $request->file('supporting_partner_image');
		if($fileName_array != null){
				foreach($fileName_array as $Image_array)
				{
					$Image_Naming = $Image_array->getClientOriginalName();
					$Image_partialname = pathinfo($Image_Naming,PATHINFO_FILENAME);
					$Image_extension = $Image_array->guessClientExtension();
					$Image_finalname = $Image_partialname.'_'.time().'.'.$Image_extension;
					$ProgrammeImage = new ProgrammeImage();
					$ProgrammeImage->filename = $Image_finalname;
					$ProgrammeImage->pid = $id;
					$ProgrammeImage->save();
				}
			}
					//===========================_//
					//      Update programme       //
					//===========================///
					$Programme = Programme::find($id);
					if(!$Programme) throw new ModelNotFoundException;
					$Programme->fill($request->all());
					$Programme->save();


					//===========================_//
					//      Send Notification       //
					//===========================///
					$registered_volunteers = InterestedProgramme::where('pid',$id)->get();
					if(count($registered_volunteers)>0){
						$notification = new Notification;
						$notification->title = 'Updated <'.$request->name.'> Programme';
						$notification->description = 'The programme named: <'.$request->name.'> is updated. You can check the further details in view profile page.';
						$notification->for_volunteer = 1;
						$notification->for_admin = 0;
						$notification->broadcast = 0;
						$notification->is_auto = 1;
						$notification->created_by = $Programme->created_by ;
						$notification->category = 2;
						$notification->save();

						foreach($registered_volunteers as $registered_volunteer){
						$volunteer_notification = new VolunteerNotification;
						$volunteer_notification->vid = $registered_volunteer->vid;
						$volunteer_notification->nid = $notification->nid;
						$volunteer_notification->save();
						}
					}

					return redirect()->route('programme.index')->with('alert', 'Programme Updated Successfully!'); 
    }

		public function delete($id)
    {
			//===========================_//
			//  Delete images in database //
			// 	Delete images in storage  //
			//===========================///
			$ProgrammeImage = ProgrammeImage::where('pid',$id)->get();
			foreach($ProgrammeImage as $Image)
			{
				$result = Storage::disk('public')->delete('cover_image/'.$Image->filename);
				$Image->delete();
			} 

			//===========================_//
			//     Delete programme       //
			//    Delete Related Events  //
			//===========================///
			$Programme = Programme::where('pid', $id)->delete();
			$Event = Event::where('pid', $id)->delete();
			if(!$Programme) throw new ModelNotFoundException;
			if(!$ProgrammeImage) throw new ModelNotFoundException;

			//===========================_//
			//      Send Notification       //
			//===========================///
			$registered_volunteers = InterestedProgramme::where('pid',$id)->get();
			if(count($registered_volunteers)>0){
			$notification = new Notification;
			$notification->title = 'Deleted <'.$request->name.'> Programme';
			$notification->description = 'The programme named: <'.$request->name.'> is removed due to some issues. You are welcome to take part in other programmes.';
			$notification->for_volunteer = 1;
			$notification->for_admin = 0;
			$notification->broadcast = 0;
			$notification->is_auto = 1;
			$notification->created_by = $Programme->created_by ;
			$notification->category = 2;
			$notification->save();

			foreach($registered_volunteers as $registered_volunteer){
			$volunteer_notification = new VolunteerNotification;
			$volunteer_notification->vid = $registered_volunteer->vid;
			$volunteer_notification->nid = $notification->nid;
			$volunteer_notification->save();
				}
			}

			return redirect()->route('programme.index')->with('alert', 'Programme Deleted Successfully!'); 
	}
	
	public function select_tab(Request $request)
{
 if($request->ajax())
 {
  $output = '';

  $query = $request->get('query');
  
  if($query == '1st_quater')
  {
  $data = \DB::table('programmes')
  ->whereBetween('start_month',[1,3])
  ->get();
  }elseif($query == '4th_quater'){
    $data = \DB::table('programmes')
	->whereBetween('start_month',[10,12])
	->orwhereBetween('end_month',[10,12])
	->get();
  }elseif($query == '2nd_quater'){
	$data = \DB::table('programmes')
	->whereBetween('start_month',[4,6])
	->orwhereBetween('end_month',[4,6])
	->get();
  }elseif($query == '3rd_quater'){
    $data = \DB::table('programmes')
	->whereBetween('start_month',[7,9])
	->orwhere('end_month',[7,9])
	->get();
  }

  $total_row = $data->count();
  if($total_row > 0)
  {
	  $output ='<div>
    <table>
        <tr>
			<th>Programme Name</th>
			<th>Code</th>
			<th>Duration</th>
			<th>Target</th>
			<th>Details</th>
            
        </tr>';
   foreach($data as $row)
   { 
	$output .= ' 
        <tr>
		<td>'.$row->name.'</td>
			<td>'.$row->code.'</td>
			<td>'.date('F',mktime(0,0,0,((int) $row->start_month)+1,0,0)).' - '.date('F',mktime(0,0,0,((int) $row->end_month)+1,0,0)).'</td>
			<td>'.$row->target.'</td>
			<td><form method="post" class="myForm" action="">
            <input type="text" name="pid" value="'.$row->pid.'" hidden>
            <input type="submit" value="See more" class="btn btn-primary">
          </form>
        	</td>
			</tr>

    ';
   }
   $output .='
   </table></div>';
  }
  else
  {
   $output = '
    <h1>No Available Programme</h1>
   ';
  }
  $data = array(
   'table_data'  => $output,
   'total_row' => $total_row
  );

  echo json_encode($data);
 }
 
}
}
