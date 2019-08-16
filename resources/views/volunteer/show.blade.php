<?php

use App\Common;
?>

@extends('master', ['title'=>'My Profile'])
@section('container')



  <style>

fieldset
	{
		border: 1px solid #ddd !important;
		margin-top:3%;
		margin-left: auto;
		margin-right:auto;
		xmin-width: 0;
		padding: 10px;
		position: relative;
		border-radius:4px;
		background-color:#f5f5f5;
		padding-left:10px!important;
	}

		legend
		{
			font-size:14px;
			font-weight:bold;
			margin-bottom: 0px;
			width: 35%;
			border: 1px solid #ddd;
			border-radius: 4px;
			padding: 5px 5px 5px 10px;
			background-color: #ffffff;
    }

    input[type="text"]:disabled {
  background: #fafafa;
    }
  
    .profile-img {
  border: 1px solid #ddd;
  border-radius: 4px;
  padding: 5px;
  width: 100px;
  margin-left:auto;
  margin-right:auto;
  margin-top:50px;
}

img:hover {
  box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
}
}

</style>
  <div class="register_container" >

      <div class="form-group row">
      <img src="/storage/profile_image/{{$volunteer->profile_image}}" alt="Forest" style="width:150px;height:150px;" class="profile-img">
      </div>
      <div class="first-info">
                     <table style="float:left">
                            <tr>
                              <th>Full Name</th>
                              <td>{{$volunteer->name}}</td>
                            <tr>
                            <tr>
                              <th>NRIC</th>
                              <td>{{$volunteer->nric}}</td>
                            <tr>
                            <tr>
                              <th>Gender</th>
                              <td>{{$volunteer->gender}}</td>
                            <tr>
                            <tr>
                              <th>Nationality</th>
                              <td>{{$volunteer->nationality}}</td>
                            <tr>
                            <tr>
                              <th>Race</th>
                              <td>{{$volunteer->race}}</td>
                            <tr>
                     </table>

                     <table  style="float:right">
                            <tr>
                              <th>Emergency Contact Name</th>
                              <td>{{$volunteer->em_person}}</td>
                            <tr>
                            <tr>
                              <th>Relationship</th>
                              <td>{{$volunteer->em_relation}}</td>
                            <tr>
                            <tr>
                              <th>Emergency Contact Number</th>
                              <td>{{$volunteer->em_contact_no}}</td>
                            <tr>
                            
                     </table>
                     </div>
<div class="second-info">
        <table style="float:left">
                            <tr>
                              <th>Email</th>
                              <td>{{$volunteer->email}}</td>
                            <tr>
                            <tr>
                              <th>Contact</th>
                              <td>{{$volunteer->contact_no}}</td>
                            <tr>
                            <tr>
                              <th>Address</th>
                              <td>{{$volunteer->address}}</td>
                            <tr>
                     </table>                     
</div>

<div class="third-info">
<table style="float:left">
                            <tr>
                              <th>Education level</th>
                              @foreach(Common::$educationLvl as $index => $name)
                                @if($index == $volunteer->education_level )
                                <td>{{$name}}</td>
                                @endif
                              @endforeach
                              
                            <tr>
                            <tr>
                              <th>Occupation</th>
                              <td>{{$volunteer->occupation}}</td>
                            <tr>     
                            <tr>
                        <th>Area of contribution</th>
                            @foreach(Common::$SkillsetsShortform as $index => $names)
                              @foreach(Common::$ContributeArea as $category => $cat_names)
                                @if($names == $category)
                                  @if($skillsetslist->$names == 1)
                                    <td>{{$cat_names}}</td>
                                  @endif
                                @endif
                              @endforeach
                            @endforeach   
                            
                            
                      @foreach(Common::$SkillsetsShortform as $index => $names)
                        @foreach(Common::$SubContributeArea as $category => $cat_names)
                          @foreach($cat_names as $subcat => $subcat_names)
                            @if($names == $subcat)
                              @if($skillsetslist->$names == 1)
                              
                                <td>{{$subcat_names}}</td>
                               
                              @endif
                            @endif
                          @endforeach
                        @endforeach
                      @endforeach   
                      <tr>  
                     </table>

</div>
                     

                     

                     

                     <div class="col-sm-12" style="margin-bottom:-6px;">
            <table class='table table-striped table-bordered text-center'>
              <col width="20%">
              <col width="16%">
              <col width="16%">
              <col width="16%">
              <col width="16%">
              <col width="16%">
              <thead class='thead-dark text-center'>
                <tr>
                  <th>
                    <label>Language</label>
                  </th>
                  @foreach(Common::$Strength as $value)
                  <th>
                    <label>{{$value}}</label>
                  </th>
                  @endforeach
                </tr>
              </thead>
              <tbody class='thead-dark'>
              @foreach(Common::$Language as $skill_key => $skill_value)
              <tr>
                <th scope='row'>
                  <label>{{$skill_value}}</label>
                </th>
                @foreach($skillset as $s_key => $s_value)
                @if($skill_key == $s_key)
                @foreach(Common::$Strength as $key => $value)
                <td onclick='set(this)'>
                  @if($key==$s_value)
                  <input type='radio' name="{{$skill_key}}" value="{{$key}}" checked disabled/>
                  @else
                  <input type='radio' name="{{$skill_key}}" value="{{$key}}" disabled/>
                  @endif
                </td>
                @endforeach
                @endif
                @endforeach
              </tr>
              @endforeach
              </tbody>
            </table>
          </div>

          <!-- Skills -->
          <div class="col-sm-12" style="margin-top:-20px;">
            <table class='table table-striped table-bordered text-center'>
              <col width="20%">
              <col width="20%">
              <col width="20%">
              <col width="20%">
              <col width="20%">
              @foreach(Common::$Skillsets as $skill_category_key => $skill_category_value)
              <thead class='thead-dark'>
                <tr>
                  <th>
                    <label>{{$skill_category_key}}</label>
                  </th>
                  @foreach(Common::$Proficient as $value)
                  <th>
                    <label>{{$value}}</label>
                  </th>
                  @endforeach
                </tr>
              </thead>
              <tbody class='thead-dark'>
              @foreach($skill_category_value as $skill_key => $skill_value)
              @foreach($skillset as $s_key => $s_value)
              @if($skill_key == $s_key)
              <tr>
                <th scope='row'>
                  <label class="text-left col-sm-9">{{$skill_value}}</label>
                </th>
                @foreach(Common::$Proficient as $key => $value)
                <td onclick='set(this)'>
                  @if($key== $s_value)
                  <input type='radio' name="{{$skill_key}}" value="{{$key}}" checked disabled />
                  @else
                  <input type='radio' name="{{$skill_key}}" value="{{$key}}" disabled/>
                  @endif
                </td>
                @endforeach
              </tr>
              @endif
              @endforeach
              @endforeach
              </tbody>
              @endforeach
            </table>
          </div>
                     </div>
                     @if(Session::get('authority')=='volunteer')
                     <button class='btn btn-block btn-primary' style="margin-bottom:20px;">
                      <a href='{{route("volunteer.edit", $volunteer->vid)}}'>Edit Profile</a>
                    </button>
                    <button class='btn btn-block btn-primary' style="margin-bottom:20px;">
                      <a href='{{route("volunteer.password", $volunteer->vid)}}'>Change Password</a>
                    </button>
                    @endif
@endsection
