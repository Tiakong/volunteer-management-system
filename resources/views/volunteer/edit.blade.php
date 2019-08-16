<?php

use App\Common;
?>

@extends('master', ['title'=>'Edit Profile'])
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


}

</style>

  <div class="register_container" >
  <ul class="nav nav-tabs">
    <li><a data-toggle="tab" id="all_event" href="" onclick="page1Toggle()">Personal Details</a></li>
    <li><a data-toggle="tab" id="past_event" href=""  onclick="page2Toggle()">Other Details</a></li>
    <li><a data-toggle="tab" id="ongoing_event" href="" onclick="page3Toggle()">Skill and Proficiency</a></li>
  </ul>


  <form id="update-form" name='update' method="post" action="{{route('volunteer.update')}}" enctype="multipart/form-data">

      {{csrf_field()}}
      <div class="tab-content" id="tab-content-display">
        <div class="login-wrap">
          <div class="login-html">
            <div class="login-form">
              <div class="sign-in-htm">
                <div class="group">
                  <div class="form-group">
                    @include('common.show-error')
                    <div class="form-group row">

                        <fieldset class="col-md-9 ">
                          <legend>Personal Information</legend>

                          <div class="panel panel-default">
                            <div class="panel-body">
                              <div class="form-group row">
                                {!! Form::label('name', 'Full Name', [
                                'class' => 'control-label col-sm-4',
                              ]) !!}
                                <div class="col-sm-6">
                                  <input type="text" name="name" class="form-control mb-4" value="{{$volunteer->name}}"/>
                                </div>
                              </div>

                              <div class="form-group row">
                                {!! Form::label('nric', 'IC No.', [
                                  'class' => 'control-label col-sm-4',
                                ]) !!}
                                <div class="col-sm-6">
                                  <input type="text" name="nric" class="form-control mb-4" value="{{$volunteer->nric}}"/>
                                </div>
                              </div>

                              <div class="form-group row">
                                {!! Form::label('gender', 'Gender', [
                                    'class' => 'control-label col-sm-4',
                                  ]) !!}
                                <div class="col-sm-3">
                                  {!! Form::select('gender', Common::$volunteerGender, $volunteer->gender, [
                                    'id'	=> 'gender',
                                    'class' => 'form-control form-control-lg',
                                    'onchange' => 'SetDescription(this)',
                                    'placeholder' => '- All -',
                                  ]) !!}
                                </div>
                              </div>

                              <div class="form-group row">
                                {!! Form::label('nationality', 'Nationality', [
                                  'class' => 'control-label col-sm-4',
                                ]) !!}
                                <div class="col-sm-4">
                                  <input type="text" name="nationality" class="form-control mb-4" value="{{$volunteer->nationality}}"/>
                                </div>
                              </div>
                              <div class="form-group row">
                                {!! Form::label('race', 'Race', [
                                  'class' => 'control-label col-sm-4',
                                ]) !!}
                                <div class="col-sm-3">
                                  <input type="text" name="race" class="form-control mb-4" value="{{$volunteer->race}}"/>
                                </div>
                              </div>
                            </div>
                          </div>
                        </fieldset>

                        <fieldset class="col-md-9 ">
                          <legend>Personal Contact</legend>

                          <div class="panel panel-default">
                            <div class="panel-body">
                              <div class="form-group row">
                                {!! Form::label('volunteer-email', 'Email', [
                                  'class' => 'control-label col-sm-4',
                                ]) !!}

                                <div class="col-sm-5">
                                  <input type="email" name="email" class="form-control mb-4" value="{{$volunteer->email}}"/>
                                </div>
                              </div>

                              <div class="form-group row">
                                {!! Form::label('volunteer-contact_no', 'Contact Number', [
                                    'class' => 'control-label col-sm-4',
                                  ]) !!}
                                  <div class="col-sm-5">
                                    <input type="tel" name="contact_no" class="form-control mb-4" value="{{$volunteer->contact_no}}"/>
                                  </div>
                              </div>

                              <div class="form-group row">
                                {!! Form::label('address', 'Address', [
                                  'class' => 'control-label col-sm-4',
                                ]) !!}
                                <div class="col-sm-7">
                                  <input type="text" name="address1" class="form-control mb-4" value="{{$volunteer->address}}"/>
                                </div>
                              </div>

                            </div>
                          </div>
                        </fieldset>

                        <fieldset class="col-md-9 ">
                          <legend>Emergency Contact</legend>

                          <div class="panel panel-default">
                            <div class="panel-body">
                              <div class="form-group row">
                                {!! Form::label('em_person', 'Emergency Contact Name', [
                                  'class' => 'control-label col-sm-4',
                                ]) !!}
                                <div class="col-sm-7">
                                  <input type="text" name="em_person" class="form-control mb-4" value="{{$volunteer->em_person}}"/>
                                </div>
                              </div>
                              <div class="form-group row">
                                {!! Form::label('em_relation', 'Relationship', [
                                  'class' => 'control-label col-sm-4',
                                ]) !!}
                                <div class="col-sm-4">
                                  <input type="text" name="em_relation" class="form-control mb-4" value="{{$volunteer->em_relation}}"/>
                                </div>
                              </div>
                              <div class="form-group row">
                                {!! Form::label('em_contact_no', 'Emergency Contact Number', [
                                  'class' => 'control-label col-sm-4',
                                ]) !!}
                                <div class="col-sm-5">
                                  <input type="tel" name="em_contact_no" class="form-control mb-4" value="{{$volunteer->em_contact_no}}" />
                                </div>
                              </div>
                            </div>
                          </div>
                        </fieldset>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="tab-content" id="tab-content2-display">
        <div class="login-wrap">
          <div class="login-html">
            <div class="login-form">
              <div class="sign-up-htm">
                <div class="group">
                  <div class="form-group">
                    <div class="form-group row">
                      <fieldset class="col-md-9 ">
                        <legend>Background</legend>

                        <div class="panel panel-default">
                          <div class="panel-body">
                            <div class="form-group row">
                              {!! Form::label('education_level', 'Education Level', [
                                  'class' => 'control-label col-sm-4',
                                ]) !!}
                                <div class="col-sm-5">
                                  {!! Form::select('education_level', Common::$educationLvl, $volunteer->education_level, [
                                    'id'	=> 'education_level',
                                    'class' => 'form-control form-control-lg',
                                    'onchange' => 'SetEducation(this)',
                                    'placeholder' => '- All -',
                                  ]) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                              {!! Form::label('occupation', 'Occupation', [
                                'class' => 'control-label col-sm-4',
                              ]) !!}
                              <div class="col-sm-5">
                                <input type="text" name="occupation" class="form-control mb-4" value="{{$volunteer->occupation}}"/>
                              </div>
                            </div>
                          </div>
                        </div>
                      </fieldset>

                      <fieldset class="col-md-9 ">
                        <legend>Others</legend>

                        <div class="panel panel-default">
                          <div class="panel-body">
                          <div class="form-group row">
                              {!! Form::label('remark', 'Remark', [
                                'class' => 'control-label col-sm-4',
                              ]) !!}
                              <div class="col-sm-5">
                                <input type="text" name="remark" class="form-control mb-4" value="{{$volunteer->remark}}" />
                              </div>
                            </div>

                            <div class="form-group row">
                              {!! Form::label('programme', 'Programmes That You Interested In (Can Choose More Than 1)', [
                                  'style= "margin-left :15px"',
                              ]) !!}
                              <div class="col-sm-9">

                                @foreach(Common::getProgrammes() as $pcode => $pname)
                                <?php $i=false ?>
                                  @foreach($programmes as $index => $programme)
                                    @if($programme->code == $pcode)
                                    <?php $i=true ?>
                                    @break
                                    @endif
                                  @endforeach
                                  @if($i==true)
                                    <input type="checkbox" name="{{$pcode}}" value={{$pcode}} checked>{{$pcode}}-{{$pname}}
                                    </br>
                                    @else
                                    <input type="checkbox" name="{{$pcode}}" value={{$pcode}}>{{$pcode}}-{{$pname}}
                                    </br>
                                    <?php $i=false ?>
                                    @endif
                                @endforeach
                              </div>
                            </div>



                            <div class="form-group row">
                              {!! Form::label('profile_image', 'Please upload an image as your profile picture', [
                                'style= "margin :15px"',
                              ]) !!}
                              <div class="col-sm-9">
                                <input type="file" style=" width:60%;font-size:16px;" name="profile_image" id="fileToUpload">
                              </div>
                            </div>
                          </div>
                        </div>
                      </fieldset>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
	    </div>


      <div class="tab-content" id="tab-content3-display">
        <div class="login-wrap">
          <div class="login-html">
            <div class="login-form">
              <div class="sign-up-htm">
                  <div class="form-group">
                    <div class="form-group row">
                      <fieldset class="col-sm-11 ">
                        <legend>Areas You Can Contribute</legend>
                          <div class="col-sm-9">

                              @foreach(Common::$SkillsetsShortform as $index => $shortform)
                                  @foreach(Common::$ContributeArea as $area_code => $area_name)
                                    @if($shortform == $area_code)
                                      @if($shortform == "funding")
                                        @if($skillsetslist->$shortform == '1')
                                        <div class='row'>
                                          <input type="checkbox" name="funding" value="1" checked>
                                            <label> Funding </label>
                                        </div>
                                        @else
                                        <div class='row'>
                                          <input type="checkbox" name="funding" value="1">
                                            <label> Funding </label>
                                        </div>
                                        @endif
                                      @endif
                                    @endif
                                    @endforeach
                              @endforeach

                              @foreach(Common::$SkillsetsShortform as $index => $shortform)
                                  @foreach(Common::$ContributeArea as $area_code => $area_name)
                                    @if($shortform == $area_code)
                                      @if($shortform == "branding")
                                        @if($skillsetslist->$shortform == '1')
                                        <div class='row'>
                                          <input type="checkbox" name="branding" value="1" checked>
                                            <label> Branding </label>
                                        </div>
                                        @else
                                        <div class='row'>
                                          <input type="checkbox" name="branding" value="1">
                                            <label> Branding </label>
                                        </div>
                                        @endif
                                      @endif
                                    @endif
                                    @endforeach
                              @endforeach


                              @foreach(Common::$SkillsetsShortform as $index => $shortform)
                                  @foreach(Common::$ContributeArea as $area_code => $area_name)
                                    @if($shortform == $area_code)
                                      @if($shortform == "entrepreneurship")
                                        @if($skillsetslist->$shortform == '1')
                                        <div class='row'>
                                          <input type="checkbox" name="entrepreneurship" value="1" checked>
                                            <label> Entrepreneurship </label>
                                        </div>
                                        @else
                                        <div class='row'>
                                          <input type="checkbox" name="entrepreneurship" value="1">
                                            <label> Entrepreneurship </label>
                                        </div>
                                        @endif
                                      @endif
                                    @endif
                                    @endforeach
                              @endforeach

                            <div class="row">
                              <input type="checkbox" name='dgt' id='digital'>
                              <label> Digital </label>
                            </div>

                            <div id="digitalcheck" style="display: none">
                            @foreach(Common::$SkillsetsShortform as $index => $shortform)
                                      @foreach(Common::$SubContributeArea as $area_code => $area_name)
                                      @foreach($area_name as $area_sub_code => $area_sub_name)
                                        @if($shortform == $area_sub_code)
                                          @if($shortform == "dgtMultimedia")
                                            @if($skillsetslist->$shortform == '1')
                                            <input type="checkbox" name="dgtMultimedia" style="margin-left:20px;" value=1 checked><label>Multimedia</label>
                                            @else
                                            <input type="checkbox" name="dgtMultimedia" style="margin-left:20px;" value=1><label>Multimedia</label>
                                            @endif
                                          @endif
                                        @endif
                                        @endforeach
                                        @endforeach
                              @endforeach

                              @foreach(Common::$SkillsetsShortform as $index => $shortform)
                                      @foreach(Common::$SubContributeArea as $area_code => $area_name)
                                      @foreach($area_name as $area_sub_code => $area_sub_name)
                                        @if($shortform == $area_sub_code)
                                          @if($shortform == "dgtIT")
                                            @if($skillsetslist->$shortform == '1')
                                            <input type="checkbox" name="dgtIT" style="margin-left:20px;" value=1 checked><label>IT</label>
                                            @else
                                            <input type="checkbox" name="dgtIT" style="margin-left:20px;" value=1><label>IT</label>
                                            @endif
                                          @endif
                                        @endif
                                        @endforeach
                                        @endforeach
                              @endforeach

                              @foreach(Common::$SkillsetsShortform as $index => $shortform)
                                      @foreach(Common::$SubContributeArea as $area_code => $area_name)
                                      @foreach($area_name as $area_sub_code => $area_sub_name)
                                        @if($shortform == $area_sub_code)
                                          @if($shortform == "dgtSocialMedia")
                                            @if($skillsetslist->$shortform == '1')
                                            <input type="checkbox" name="dgtSocialMedia" style="margin-left:20px;" value=1 checked><label>Social Media</label>
                                            @else
                                            <input type="checkbox" name="dgtSocialMedia" style="margin-left:20px;" value=1><label>Social Media</label>
                                            @endif
                                          @endif
                                        @endif
                                        @endforeach
                                        @endforeach
                              @endforeach

                            </div>

                            <script>
                            $(function () {
                              $("#digital").click(function () {
                                if ($(this).is(":checked")) {
                                  $("#digitalcheck").show();
                                } else {
                                  $("#digitalcheck").hide();
                                }
                              });
                            });
                            </script>

                    @foreach(Common::$SkillsetsShortform as $index => $shortform)
                                      @foreach(Common::$ContributeArea as $area_code => $area_name)
                                        @if($shortform == $area_code)
                                          @if($shortform == "business")
                                            @if($skillsetslist->$shortform == '1')
                                            <div class='row'>
                                              <input type="checkbox" name="business" value="1" checked>
                                                <label> Business </label>
                                            </div>
                                            @else
                                            <div class='row'>
                                              <input type="checkbox" name="business" value="1">
                                                <label> Business </label>
                                            </div>
                                            @endif
                                          @endif
                                        @endif
                                        @endforeach
                              @endforeach

                            <!-- <div id="businesscheck" style="display: none">
                                <input type="checkbox"><label>Has Own Company</label>
                            </div>

                            <script type="text/javascript">
                              $(function () {
                              $("#business").click(function () {
                                  if ($(this).is(":checked")) {
                                      $("#businesscheck").show();
                                  } else {
                                      $("#businesscheck").hide();
                                  }
                                });
                              });
                            </script> -->

                            <div class="row">
                              <input type="checkbox" id='arts' name="ctv">
                              <label>Creative</label>
                            </div>

                            <div id="artscheck" style="display: none">
                            @foreach(Common::$SkillsetsShortform as $index => $shortform)
                                      @foreach(Common::$SubContributeArea as $area_code => $area_name)
                                      @foreach($area_name as $area_sub_code => $area_sub_name)
                                        @if($shortform == $area_sub_code)
                                          @if($shortform == "ctvArt")
                                            @if($skillsetslist->$shortform == '1')
                                            <input type="checkbox" name="ctvArt" style="margin-left:20px;" value=1 checked><label>Art</label>
                                            @else
                                            <input type="checkbox" name="ctvArt" style="margin-left:20px;" value=1><label>Art</label>
                                            @endif
                                          @endif
                                        @endif
                                        @endforeach
                                        @endforeach
                              @endforeach

                              @foreach(Common::$SkillsetsShortform as $index => $shortform)
                                      @foreach(Common::$SubContributeArea as $area_code => $area_name)
                                      @foreach($area_name as $area_sub_code => $area_sub_name)
                                        @if($shortform == $area_sub_code)
                                          @if($shortform == "ctvDraw")
                                            @if($skillsetslist->$shortform == '1')
                                            <input type="checkbox" name="ctvDraw" style="margin-left:20px;" value=1 checked><label>Draw</label>
                                            @else
                                            <input type="checkbox" name="ctvDraw" style="margin-left:20px;" value=1><label>Draw</label>
                                            @endif
                                          @endif
                                        @endif
                                        @endforeach
                                        @endforeach
                              @endforeach

                              @foreach(Common::$SkillsetsShortform as $index => $shortform)
                                      @foreach(Common::$SubContributeArea as $area_code => $area_name)
                                      @foreach($area_name as $area_sub_code => $area_sub_name)
                                        @if($shortform == $area_sub_code)
                                          @if($shortform == "ctvDance")
                                            @if($skillsetslist->$shortform == '1')
                                            <input type="checkbox" name="ctvDance" style="margin-left:20px;" value=1 checked><label>Dance</label>
                                            @else
                                            <input type="checkbox" name="ctvDance" style="margin-left:20px;" value=1><label>Dance</label>
                                            @endif
                                          @endif
                                        @endif
                                        @endforeach
                                        @endforeach
                              @endforeach


                              @foreach(Common::$SkillsetsShortform as $index => $shortform)
                                      @foreach(Common::$SubContributeArea as $area_code => $area_name)
                                      @foreach($area_name as $area_sub_code => $area_sub_name)
                                        @if($shortform == $area_sub_code)
                                          @if($shortform == "ctvThretre")
                                            @if($skillsetslist->$shortform == '1')
                                            <input type="checkbox" name="ctvThretre" style="margin-left:20px;" value=1 checked><label>Theatre</label>
                                            @else
                                            <input type="checkbox" name="ctvThretre" style="margin-left:20px;" value=1><label>Theatre</label>
                                            @endif
                                          @endif
                                        @endif
                                        @endforeach
                                        @endforeach
                              @endforeach

                              @foreach(Common::$SkillsetsShortform as $index => $shortform)
                                      @foreach(Common::$SubContributeArea as $area_code => $area_name)
                                      @foreach($area_name as $area_sub_code => $area_sub_name)
                                        @if($shortform == $area_sub_code)
                                          @if($shortform == "ctvMusic")
                                            @if($skillsetslist->$shortform == '1')
                                            <input type="checkbox" name="ctvMusic" style="margin-left:20px;" value=1 checked><label>Music</label>
                                            @else
                                            <input type="checkbox" name="ctvMusic" style="margin-left:20px;" value=1><label>Music</label>
                                            @endif
                                          @endif
                                        @endif
                                        @endforeach
                                        @endforeach
                              @endforeach
                            </div>

                            <script type="text/javascript">
                            $(function () {
                              $("#arts").click(function () {
                              if ($(this).is(":checked")) {
                                  $("#artscheck").show();
                              } else {
                                  $("#artscheck").hide();
                              }
                              });
                            });
                            </script>

                            <div class="row">
                              <input type="checkbox" id="communication" name="cmm">
                              <label>Communication</label>
                            </div>

                            <div id="communicationcheck" style="display: none">
                            @foreach(Common::$SkillsetsShortform as $index => $shortform)
                                      @foreach(Common::$SubContributeArea as $area_code => $area_name)
                                      @foreach($area_name as $area_sub_code => $area_sub_name)
                                        @if($shortform == $area_sub_code)
                                          @if($shortform == "cmmMarket")
                                            @if($skillsetslist->$shortform == '1')
                                            <input type="checkbox" name="cmmMarket" style="margin-left:20px;" value=1 checked><label>Marketing</label>
                                            @else
                                            <input type="checkbox" name="cmmMarket" style="margin-left:20px;" value=1><label>Marketing</label>
                                            @endif
                                          @endif
                                        @endif
                                        @endforeach
                                        @endforeach
                              @endforeach

                              @foreach(Common::$SkillsetsShortform as $index => $shortform)
                                      @foreach(Common::$SubContributeArea as $area_code => $area_name)
                                      @foreach($area_name as $area_sub_code => $area_sub_name)
                                        @if($shortform == $area_sub_code)
                                          @if($shortform == "cmmMedia")
                                            @if($skillsetslist->$shortform == '1')
                                            <input type="checkbox" name="cmmMedia" style="margin-left:20px;" value=1 checked><label>Media</label>
                                            @else
                                            <input type="checkbox" name="cmmMedia" style="margin-left:20px;" value=1><label>Media</label>
                                            @endif
                                          @endif
                                        @endif
                                        @endforeach
                                        @endforeach
                              @endforeach

                              @foreach(Common::$SkillsetsShortform as $index => $shortform)
                                      @foreach(Common::$SubContributeArea as $area_code => $area_name)
                                      @foreach($area_name as $area_sub_code => $area_sub_name)
                                        @if($shortform == $area_sub_code)
                                          @if($shortform == "cmmPresentation")
                                            @if($skillsetslist->$shortform == '1')
                                            <input type="checkbox" name="cmmPresentation" style="margin-left:20px;" value=1 checked><label>Presentation Skills</label>
                                            @else
                                            <input type="checkbox" name="cmmPresentation" style="margin-left:20px;" value=1><label>Presentation Skills</label>
                                            @endif
                                          @endif
                                        @endif
                                        @endforeach
                                        @endforeach
                              @endforeach
                            </div>

                            <script type="text/javascript">
                            $(function () {
                              $("#communication").click(function () {
                              if ($(this).is(":checked")) {
                                  $("#communicationcheck").show();
                              } else {
                                  $("#communicationcheck").hide();
                              }
                              });
                            });
                            </script>

                          </div>



                      </fieldset>
          <!-- Language -->
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
                              <input type='radio' name="{{$skill_key}}" value="{{$key}}" checked />
                              @else
                              <input type='radio' name="{{$skill_key}}" value="{{$key}}" />
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
                              <input type='radio' name="{{$skill_key}}" value="{{$key}}" checked />
                              @else
                              <input type='radio' name="{{$skill_key}}" value="{{$key}}" />
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

                      <div class= "col-sm-11">
                        <input type="submit" value="Update" class="btn btn-primary" >
                        <button onClick=""class="btn btn-danger" >Cancel</button>
                      </div>
                      </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
    </div>

    </form>
</div>


<div style="text-align:center;margin:10px;">
	<button onclick="back_to_login()" class="btn btn-danger" >Cancel</button>
	</div>
<script>


function openTab(evt, TabName) {
      var i, tabcontent, tablinks;
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
      }
      document.getElementById(TabName).style.display = "block";
      evt.currentTarget.className += " active";

    }

    document.getElementById("clickme").click();

var tabs = $('.multiple-tabs');
   var selector = $('.multiple-tabs').find('a').length;
   //var selector = $(".tabs").find(".selector");
   var activeItem = tabs.find('.active');
   var activeWidth = activeItem.innerWidth();
   $(".tab-selector").css({
     "left": activeItem.position.left + "px",
     "width": activeWidth + "px"
   });

   $(".multiple-tabs").on("click","a",function(e){
     e.preventDefault();
     $('.multiple-tabs a').removeClass("active");
     $(this).addClass('active');
     var activeWidth = $(this).innerWidth();
     var itemPos = $(this).position();
     $(".tab-selector").css({
       "left":itemPos.left + "px",
       "width": activeWidth + "px"
     });
   });

   $(document).ready(function(){
        $("#personal-info :input[type='text']").prop("disabled", true);
        $("#skills :input[type='radio']").prop("disabled", true);
    });

    function page1Toggle() {
  var x = document.getElementById("tab-content-display");
  var y = document.getElementById("tab-content2-display");
  var z = document.getElementById("tab-content3-display");
    x.style.display = "block";
    y.style.display = "none";
	z.style.display = "none";

}

function page2Toggle() {
	var x = document.getElementById("tab-content-display");
  var y = document.getElementById("tab-content2-display");
  var z = document.getElementById("tab-content3-display");
    x.style.display = "none";
    y.style.display = "block";
	z.style.display = "none";
}

function page3Toggle() {
	var x = document.getElementById("tab-content-display");
  var y = document.getElementById("tab-content2-display");
  var z = document.getElementById("tab-content3-display");
    x.style.display = "none";
    y.style.display = "none";
	z.style.display = "block";
}
</script>

  </script>
@endsection
