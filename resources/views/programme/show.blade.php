<?php

use App\Common;

 ?>

 @extends('programme.master', ['title'=>'View Programme Details'])
 @section('content')


<div class="program-table">
                <table>
                    <tr>
                        <td><b>Name:</b></td>
                        <td>
                          <div>
                            {{ $programme->name}}
                          </div>
                        </td>
                    </tr>

                    <tr>
                        <td><b>Code:</b></td>
                        <td>
                          <div>
                            {{ $programme->code}}
                          </div>
                        </td>
                    </tr>

                    <tr>
                        <td><b>Duration:</b></td>
                        <td><div>  {{ Common::$Month[$programme->start_month]}} <?php echo " " ?>{{ $programme->start_year}}  <?php echo "-" ?>  {{ Common::$Month[$programme->end_month]}}<?php echo " " ?>{{ $programme->end_year}}
                        </div></td>
                    </tr>

                    <tr>
                        <td><b>Venue:</b></td>
                        <td>
                          <div>
                            {{ $programme->venue}}
                          </div>
                        </td>
                    </tr>

                    <tr>
                        <td><b>Target: </b></td>
                        <td>
                          <div>
                            {{ $programme->target}}
                          </div>
                        </td>
                    </tr>

                    <tr>
                        <td><b>Contact: </b></td>
                        <td>
                          <div>
                            {{ $programme->contact}}
                          </div>
                        </td>
                    </tr>

                    <tr>
                        <td><b>Description:</b></td>
                        <td>
                          <div>
                            {{ $programme->description}}
                          </div>
                        </td>
                    </tr>
                    <tr>

                    <tr>
                        <td><b>Created By: </b></td>
                        <td>
                          <div>
                            {{ $programme->created_by}}
                          </div>
                        </td>
                    </tr>
                    <tr>
                      
                    </tr>
                    <td><b>Supporting Partners:</b></td>
                    <td>
                    @foreach($programmeImage as $image)
                        @if(Storage::disk('public')->exists('cover_image/'.$image->filename))
                        
                            <img src ="/storage/cover_image/{{$image->filename}}" width="164" height="164"  style="margin:10px;">

                        @endif
                    @endforeach
                    </td>
                    <tr>
                      <td></td>
                      <td>
						<button class='btn btn-primary'>
						  <a href='{{route("programme.edit", $programme->pid)}}'>Edit</a>
						 </button>
						  <button class='btn  btn-danger'>
              <a href='{{route("programme.delete", $programme->pid)}}' onclick="return confirmation()">Delete</a>
							</button>
                          </td>
                    </tr>
                </table>

</div>

<script>

function confirmation()
    {

        if (!confirm("Are you sure want to delete this programme? You are not be able to recover this programme details after deleted it." + "\n" + "\n" + "Are you sure you want to Proceed?" + "\n" ))
        {
          return false;
        }
        else
        {
          return true;
        }
    }

</script>
@endsection
