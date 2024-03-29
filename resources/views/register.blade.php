<?php
use App\Common;
?>
@extends('master', ['title'=>'Volunteer Registration Form'])
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
</style>

<ul class="nav nav-tabs">
    <li><a data-toggle="tab" id="all_event" href="" onclick="page1Toggle()">Personal Details</a></li>
    <li><a data-toggle="tab" id="past_event" href=""  onclick="page2Toggle()">Other Details</a></li>
    <li><a data-toggle="tab" id="ongoing_event" href="" onclick="page3Toggle()">Skill and Proficiency</a></li>
  </ul>

  <!-- <form id="registration-form" name='registration' method="post" action="{{route('volunteer.store')}}" enctype="multipart/form-data"> -->

  {!! Form::model($volunteer,[
            'route' => ['volunteer.store'],
			'id' => 'registration-form',
            'class' => 'form horizontal',
			'method' => 'post',
            'enctype' => 'multipart/form-data',
            ]) 
          !!}

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
										<legend>Account</legend>
										<div class="panel panel-default">
											<div class="panel-body">
													<div class="form-group row">
														{!! Form::label('username', 'Username', [
															'class' => 'control-label col-sm-4',
														]) !!}

														<div class="col-sm-5">
														 {!! Form::text('username',null,[
              											  'id' => 'username',
              											  'class' =>'form-control',
              											  'required'=> 'true',
        											      ])!!}
														</div>
													</div>
												<div class="form-group row">
													{!! Form::label('password', 'Password', [
														'class' => 'control-label col-sm-4',
													]) !!}
													<div class="col-sm-5">
														 {!! Form::password('password',null,[
              											  'id' => 'password',
              											  'class' =>'form-control',
              											  
        											      ])!!}
													</div>
												</div>
												<div class="form-group row">
													{!! Form::label('password_confirmation', 'Confirm Password', [
														'class' => 'control-label col-sm-4',
													]) !!}
													<div class="col-sm-5">
													{!! Form::password('password_confirmation',null,[
              											  'id' => 'password_confirmation',
              											  'class' =>'form-control',
              											  
        											      ])!!}
													</div>
												</div>
											</div>
										</div>
									</fieldset>	
										<fieldset class="col-md-9 ">    	
										
											<legend>Personal Information</legend>
											
											<div class="panel panel-default">
												<div class="panel-body">
													<div class="form-group row">
														{!! Form::label('name', 'Full Name', [
														'class' => 'control-label col-sm-4',
													]) !!}
														<div class="col-sm-6">
														{!! Form::text('name',null,[
              											  'id' => 'name',
              											  'class' =>'form-control',
              											  
        											      ])!!}
														</div>
													</div>

													<div class="form-group row">
														{!! Form::label('nric', 'IC No.', [
															'class' => 'control-label col-sm-4',
														]) !!}
														<div class="col-sm-6">
														{!! Form::text('nric',null,[
              											  'id' => 'nric',
              											  'class' =>'form-control',
              											  
        											      ])!!}
														</div>
													</div>

													<div class="form-group row">
														{!! Form::label('gender', 'Gender', [
																'class' => 'control-label col-sm-4',
															]) !!}
														<div class="col-sm-3">
															{!! Form::select('gender', Common::$volunteerGender, null, [
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
														{!! Form::text('nationality',null,[
              											  'id' => 'nationality',
              											  'class' =>'form-control',
              											  
        											      ])!!}
														</div>
													</div>
													<div class="form-group row">
														{!! Form::label('race', 'Race', [
															'class' => 'control-label col-sm-4',
														]) !!}
														<div class="col-sm-3">
														{!! Form::text('race',null,[
              											  'id' => 'race',
              											  'class' =>'form-control',
              											  
        											      ])!!}
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
														{!! Form::label('contact_no', 'Contact Number', [
																'class' => 'control-label col-sm-4',
															]) !!}
															<div class="col-sm-5">
															{!! Form::text('contact_no',null,[
              											 	 'id' => 'contact_no',
              											 	 'class' =>'form-control',
              											 	 
        											     	 ])!!}
															</div>
													</div>

													<div class="form-group row">
														{!! Form::label('volunteer-email', 'Email', [
															'class' => 'control-label col-sm-4',
														]) !!}

														<div class="col-sm-5">
														{!! Form::email('email',null,[
              											 	 'id' => 'email',
              											 	 'class' =>'form-control',
              											 	 
        											     	 ])!!}
														</div>
													</div>

													<div class="form-group row">
														{!! Form::label('address', 'Address', [
															'class' => 'control-label col-sm-4',
														]) !!}
														<div class="col-sm-7">
														{!! Form::text('address',null,[
              											 	 'id' => 'address',
              											 	 'class' =>'form-control',
              											 	 
        											     	 ])!!}
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
														{!! Form::text('em_person',null,[
              											 	 'id' => 'em_person',
              											 	 'class' =>'form-control',
              											 	 
        											     	 ])!!}
														</div>
													</div>
													<div class="form-group row">
														{!! Form::label('em_relation', 'Relationship', [
															'class' => 'control-label col-sm-4',
														]) !!}
														<div class="col-sm-4">
														{!! Form::text('em_relation',null,[
              											 	 'id' => 'em_relation',
              											 	 'class' =>'form-control',
              											 	 
        											     	 ])!!}
														</div>
													</div>
													<div class="form-group row">
														{!! Form::label('em_contact_no', 'Emergency Contact Number', [
															'class' => 'control-label col-sm-4',
														]) !!}
														<div class="col-sm-5">
														{!! Form::tel('em_contact_no',null,[
              											 	 'id' => 'em_contact_no',
              											 	 'class' =>'form-control',
              											 	 
        											     	 ])!!}
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
															{!! Form::select('education_level', Common::$educationLvl, null, [
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
														<input type="text" name="occupation" class="form-control mb-4" />
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
														<input type="text" name="remark" class="form-control mb-4" placeholder="E.g. vegetarian / allergic ..." />
													</div>
												</div>
												<div class="form-group row">
													{!! Form::label('t_shirt_size', 'T-Shirt Size', [
														'class' => 'control-label col-sm-4',
													]) !!}
													<div class="col-sm-9">
														<input id="s"type="radio" name="t_shirt_size" value="s" >
														<label> S </label>
														<input id="m" type="radio" name="t_shirt_size" value="m" style="margin-left:30px;">
														<label> M </label>
														<input id="l"type="radio" name="t_shirt_size" value="l" style="margin-left:30px;">
														<label> L </label>
														<input id="xl"type="radio" name="t_shirt_size" value="xl" style="margin-left:30px;">
														<label> XL </label>
													</div>
												</div>

												<div class="form-group row">
													{!! Form::label('programme', 'Programmes That You Interested In (Can Choose More Than 1)', [
															'style= "margin-left :15px"',
													]) !!}
													<div class="col-sm-9">
														@foreach(Common::getProgrammes() as $pcode => $pname)
														<input type="checkbox" name="{{$pcode}}" value={{$pcode}}>{{$pcode}}-{{$pname}}
														<br>
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
													<div class='row'>
															<input type="checkbox" name="funding" value="1">
															<label> Funding </label>
														</div>

														<div class="row">
															<input type="checkbox" name="branding" value="1">
															<label>Branding</label>
														</div>
													<div class='row'>
														<input type="checkbox" name="entrepreneurship" value=1>
														<label> Entrepreneurship </label>
													</div>
										
													<div class="row">
														<input type="checkbox" name='dgt' id='digital'>
														<label> Digital </label>
													</div>

													<div id="digitalcheck" style="display: none">
														<input type="checkbox" name="dgtMultimedia" style="margin-left:20px;" value=1><label>Multimedia</label>
														<input type="checkbox" name="dgtIT" style="margin-left:20px;" value=1><label>IT</label>
														<input type="checkbox" name="dgtSocialMedia" style="margin-left:20px;" value=1><label>Social Media</label>
													
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
							
													<div class="row">
														<input type="checkbox" id='business' name="business" value=1>
														<label> Business </label>
													</div>

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
														<input type="checkbox" name="ctvArt" value=1><label>Arts</label>
														<input type="checkbox" name="ctvDraw" value=1><label>Drawing</label>
														<input type="checkbox" name="ctvDance" value=1><label>Dance</label>
														<input type="checkbox" name="ctvThretre" value=1><label>Theatre</label>
														<input type="checkbox" name="ctvMusic" value=1><label>Music</label>
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
														<input type="checkbox" name="cmmMarket" value=1><label>Marketing</label>
														<input type="checkbox" name="cmmMedia" value=1><label>Media</label>
														<input type="checkbox" name="cmmPresentation" value=1><label>Presentation Skills</label>
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

										<div class="col-sm-12">
											<table class='table table-striped table-bordered text-center'>
												<col width="15%">
												<col width="17%">
												<col width="17%">
												<col width="17%">
												<col width="17%">
												<col width="17%">
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
													@foreach(Common::$Strength as $key => $value)
													<td onclick='set(this)'>
														@if($key==0)
														<input type='radio' name="{{$skill_key}}" value="{{$key}}" checked />
														@else
														<input type='radio' name="{{$skill_key}}" value="{{$key}}" />
														@endif
													</td>
													@endforeach
												</tr>
												@endforeach
												</tbody>
											</table>
										</div>
										
										<div class="col-sm-12">
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
												<tr>
													<th scope='row'>
														<label class="text-left col-sm-9">{{$skill_value}}</label>
													</th>
													@foreach(Common::$Proficient as $key => $value)
													<td onclick='set(this)'>
														@if($key==0)
														<input type='radio' name="{{$skill_key}}" value="{{$key}}" checked />
														@else
														<input type='radio' name="{{$skill_key}}" value="{{$key}}" />
														@endif
													</td>
													@endforeach
												</tr>
												@endforeach
												</tbody>
												@endforeach
											</table>
										</div>
								
										<div class= "col-sm-11">	
											<input type="submit" value="Submit" class="btn btn-primary" >
											
										</div>
										</form>
										
									</div>				
								</div>
						</div>
					</div>
				</div>
			</div>
	</div>
	<div style="text-align:center;margin:10px;">
	<button onclick="back_to_login()" class="btn btn-danger" >Cancel</button>
	</div>
	
<script>
function back_to_login(){
	var r = confirm("Cancel registration?");
	if(r){
		window.location.href = "{{route('login')}}";
	}
}
function SetDescription(select)
{
	if(select.selectedIndex == 0)
	{
		document.querySelector("textarea[name='gender']").value = '';
	}
	else
	{
		var value = select.options[select.selectedIndex].value;
		document.querySelector("textarea[name='gender']").value = default_desc[value];
	}
}

function SetEducation(select)
{
	if(select.selectedIndex == 0)
	{
		document.querySelector("textarea[name='education_level']").value = '';
	}
	else
	{
		var value = select.options[select.selectedIndex].value;
		document.querySelector("textarea[name='education_level']").value = default_desc[value];
	}
}

function set(dom)
{
	$(dom).children('input').get(0).checked = true;
}

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


@endsection
