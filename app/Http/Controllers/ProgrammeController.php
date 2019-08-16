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
		$validatedData = $request->validate([
			'name' => 'required|unique:programmes,name',
			'code' => 'required|unique:programmes,code', 
			'cover_image[]' => 'nullable',
		  ]);

		// Save Picture Into Folder
		if($request->hasFile('cover_image'))
		{
				$fileNameWithExt = $request->file('cover_image');
				foreach($fileNameWithExt as $fileNameWithExt)
				{
					$fileNaming = $fileNameWithExt->getClientOriginalName();
					$filename = pathinfo($fileNaming,PATHINFO_FILENAME);
					$extension = $fileNameWithExt->guessClientExtension();
					$fileNameToStore = $filename.'_'.time().'.'.$extension;
					$path = $fileNameWithExt->storeAs('public/cover_image',$fileNameToStore);
				}

		}

		// Save Programme Into Database
			$Programme = new Programme();
			$Programme->fill($request->all());
			$Programme->save();

		//Retrieve Programme Id
			$Programme_pid = Programme::where('name',$Programme->name)->first();

		//Loop And Save Picture Name Into Database
			$fileName_array = $request->file('cover_image');
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

			return redirect()->route('programme.index');
	}

	//Must present if want to show a web page
	 public function show(Request $request)
    {
				$Programme = Programme::find($request->pid);
				$ProgrammeImage = ProgrammeImage::where('pid',$request->pid)->get();
				if(!$Programme) throw new ModelNotFoundException;

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

			return view('programme.edit',[
				'programme' => $Programme,
				'programmeImage' => $ProgrammeImage,
			]);
    }

	//Must present if edit is present
    public function update(Request $request, $id)
    {

		$this->validate($request,array(
			// 'name' => "required|unique:programmes,name,$id,name",
			'code' => "required|unique:programmes,code,$id,pid",
			'cover_image[]' => 'nullable',
		));

			//Retrieve selected delete image
			$selectValue =  Input::get('delete_filename');
			
			$ProgrammeImage = ProgrammeImage::where('pid',$id)->get();
			
			//Delete Selected Image In Database and Storage
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

			//Save Image Into Storage
			if($request->hasFile('cover_image'))
		{
				$fileNameWithExt = $request->file('cover_image');
				foreach($fileNameWithExt as $fileNameWithExt)
				{
					$fileNaming = $fileNameWithExt->getClientOriginalName();
					$filename = pathinfo($fileNaming,PATHINFO_FILENAME);
					$extension = $fileNameWithExt->guessClientExtension();
					$fileNameToStore = $filename.'_'.time().'.'.$extension;
					$path = $fileNameWithExt->storeAs('public/cover_image',$fileNameToStore);
				}

		}

		//Save Images Into Database
		$fileName_array = $request->file('cover_image');
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
					//Save Latest Programme Info
					$Programme = Programme::find($id);
					if(!$Programme) throw new ModelNotFoundException;

					$Programme->fill($request->all());
					$Programme->save();
					return redirect()->route('programme.index');
    }

		public function delete($id)
    {
			$ProgrammeImage = ProgrammeImage::where('pid',$id)->get();
			foreach($ProgrammeImage as $Image)
			{
				//$result = Storage::delete("/storage/cover_image/$Image->filename");
				$result = Storage::disk('public')->delete('cover_image/'.$Image->filename);
				$Image->delete();
			} 
			$Programme = Programme::where('pid', $id)->delete();
			if(!$Programme) throw new ModelNotFoundException;
			return redirect()->route('programme.index');
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
