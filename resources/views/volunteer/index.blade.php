@extends('volunteer.master', ['title'=>'My Profile'])
@section('container')

<div class="container">
	<head>
	<link rel="stylesheet" type="text/css" href="/css/register-form.css">
	</head>

<div class="login-wrap">
	<div class="login-html">
		<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab" style="font-size:35px">Personal Details</label>
		<input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab" style="font-size:35px; margin-left:50px"> Skills Proficiency</label>
		<div class="login-form">
			<div class="sign-in-htm">
				<div class="group">
					<label for="namer" class="label">Full Name</label>
					<input id="name" type="text" class="input">
				</div>
				<div class="group">
					<label for="ic" class="label">IC No.</label>
					<input id="ic" type="text" class="input">
				</div>
        <div class="group">
					<label for="emailr" class="label">Email</label>
					<input id="email" type="text" class="input">
				</div>
				<div class="group">
					<label for="pass" class="label">Password</label>
					<input id="pass" type="password" class="input" data-type="password">
				</div>
        <div class="group">
					<label for="pass" class="label">Confirm Password</label>
					<input id="pass" type="password" class="input" data-type="password" >
				</div>
        <div class="group">
          <div class="box">
					<label for="gender" class="label">Gender</label>
            <select>
              <option>Male</option>
              <option>Female</option>
            </select>
          </div>
				</div>
        <div class="group">
        <label for="age" class="label">Date Of Birth</label>
        <input id="age" type="text" class="input">
        </div>
        <div class="group">
					<label for="nationality" class="label">Nationality</label>
					<input id="nationality" type="text" class="input">
				</div>
        <div class="group">
					<label for="contactNo" class="label">Contact No</label>
					<input id="contactNo" type="text" class="input">
				</div>
        <div class="group">
          <label for="address" class="label">Address</label>
          <input id="address" type="text" class="input">
        </div>
				<div class="group">
					<div class="box">
					<label for="edclvl" class="label">Education Level</label>
						<select>
							<option>Primary School</option>
							<option>Secondary School</option>
							<option>Pre-University</option>
							<option>Bachelor Degree</option>
							<option>Master's Degree</option>
							<option>Doctoral Degree</option>
						</select>
					</div>
				</div>
				<div class="group">
					<label for="occupation" class="label">Occupation</label>
					<input id="occupation" type="text" class="input">
				</div>
				<div class="group">
					<label for="emergencyName" class="label">Emergency Contact<br><br>Name</label>
					<input id="emergencyName" type="text" class="input">
				</div>
				<div class="group">
					<label for="relationship" class="label">Relationship</label>
					<input id="relationship" type="text" class="input">
				</div>
				<div class="group">
					<label for="emergencyNo" class="label">Contact No</label>
					<input id="emergencyNo" type="text" class="input">
				</div>
				<div class="group">
					<label for="size" class="label">T-shirt Size</label>
					<input type="radio" name="size"value="s" style="margin-left:20px; left: 0;height: 20px;width: 20px;background-color: #eee;font-size:120px"><label  style="font-weight: normal;margin-left:5px;font-size: 30px;font-family: Arial, Helvetica, sans-serif;">S</label>
					<input type="radio" name="size"value="m" style="margin-left:50px; left: 0;height: 20px;width: 20px;background-color: #eee;font-size:120px"><label  style="font-weight: normal;margin-left:5px;font-size: 30px;font-family: Arial, Helvetica, sans-serif;">M</label>
					<input type="radio" name="size"value="l" style="margin-left:50px; left: 0;height: 20px;width: 20px;background-color: #eee;font-size:120px"><label  style="font-weight: normal;margin-left:5px;font-size: 30px;font-family: Arial, Helvetica, sans-serif;">L</label>
					<input type="radio" name="size"value="xl" style="margin-left:50px; left: 0;height: 20px;width: 20px;background-color: #eee;font-size:120px"><label  style="font-weight: normal;margin-left:5px;font-size: 30px;font-family: Arial, Helvetica, sans-serif;">XL</label>
				</div>
					<label for="program" class="label" style="font-size: 30px;margin:20px 0px 10px 45px;font-weight: normal;">Programmes That You Interested In (Can Choose More Than 1)</label>
					<br>
					<br>
					<div class="check">
					<input type="checkbox" ><label>Make a Difference(M.A.D)</label>
					<br>
					<br>
					<input type="checkbox" ><label> Self-empowering and Transtition Employability Program(S.T.E.P)</label>
					<br>
					<br>
					<input type="checkbox" ><label>Youth Enterpreneurship Programme(Y.E.P)</label>
					<br>
					<br>
					<input type="checkbox"><label>Change Makers' Project(CMP)</label>
					<br>
					<br>
					<input type="checkbox" ><label> Tutor a Refugee Child</label>
					<br>
					<br>
					<input type="checkbox"><label> For now on,I'm not sure which programme that I interested with</label>
          <br>
          <br>
          <button type="cancel" onClick="location.href='/'"class="cancelbtn" style="background-color: 	#CD5C5C;
          color: white;
          width:300px;
          height:60px;
          font-size:30px;
          margin-right:100px;
          float:right;
          font-family: Arial, Helvetica, sans-serif">Cancel</button>

          </div>
				<div class="hr"></div>
			</div>
			<div class="sign-up-htm">
				<label for="area" class="label" style="font-size: 30px;margin:20px 0px 10px 100px;font-weight: normal;">Areas You Can Contribute</label>
				<br>
				<br>
				<div class="check">
					<div class="column">
							<label><input type="checkbox">Enterpreneurship</label>
							<br>
							<br>
							<br>
							<label for="digital"><input type="checkbox" id=digital>Digital</label>
					<div id="digitalcheck" style="display: none">
						<fieldset>
							<input type="checkbox" style="margin-left:150px; margin-top:0px"><label>Multimedia</label>
							<input type="checkbox" style="margin-left:20px; margin-top:0px"><label>IT</label>
						</fieldset>
					</div>
					<script type="text/javascript">
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
					<br>
					<br>
					<br>
					<label><input type="checkbox" id=business>Business</label>

					<div id="businesscheck" style="display: none">
						<fieldset>
							<input type="checkbox" style="margin-left:150px; margin-top:5px"><label>Has Own Company</label>
						</fieldset>
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
					</script>

					</div>
				</div>

				<div class="check">
				<div class="column">
					<label><input type="checkbox" id=arts>Creative</label>

					<div id="artscheck" style="display: none">
					<fieldset>
						<input type="checkbox" style="margin-left:150px; margin-top:5px"><label>Arts</label>
						<input type="checkbox" style="margin-left:48px; margin-top:5px"><label>Drawing</label>
						<input type="checkbox" style="margin-left:150px; margin-top:5px"><label>Dance</label>
						<input type="checkbox" style="margin-left:20px; margin-top:5px"><label>Theatre</label>
						<br>
						<input type="checkbox" style="margin-left:150px; margin-top:5px"><label>Music</label>
					</fieldset>
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
			</div>
			<br>
			<br>
			<br>
				<div class="column">
				<label><input type="checkbox" id="communication">Communication</label>
				<div id="communicationcheck" style="display: none">
					<fieldset>
							<input type="checkbox" style="margin-left:150px; margin-top:5px"><label>Marketing</label>
							<br>
							 <input type="checkbox" style="margin-left:150px; margin-top:5px"><label>Media</label>
					</fieldset>
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
		</div>
		<label></label>
		<br>
		<br>
		<br>

		<div class ="group">
		  <br>
			<br>
		  <label for="skills" class="label" style="font-size: 30px;margin:20px 0px 10px 100px;font-weight: normal;text-align: left;">Skills Proficiency</label>
		  <br> <br>
		  <table>
		    <tr>
		      <th width="8%">Excellent</th>
		      <th width="8%">Good</th>
		      <th width="8%">Fair</th>
		      <th width="8%">Poor</th>
		      <th width="8%">Very Poor </th>
		      <th width="8%">Don't know this language</th>
		    </tr>
		  </table>
		      <label for="skills" class="label" style="font-size: 30px;margin:20px 0px 10px 100px;font-weight: normal; text-align: left;">Language</label>
		      <br>
					<br>
		      <div class="tick">
					<form action="">
		      <table>
		        <tr>
		        <td width="8%"><label for="name" class="label"style="font-size:25px;margin:0px 40px 0px 0px;font-weight: normal;text-align:left">English</label></td>
		        <td width="8%"><input type="radio" name="english" value="excellent"></td>
		        <td width="8%"><input type="radio" name="english" value="Good"></td>
		        <td width="8%"><input type="radio" name="english" value="Fair" ></td>
		        <td width="8%"><input type="radio" name="english" value="Poor" ></td>
		        <td width="8%"><input type="radio" name="english" value="Very Poor"></td>
		        <td width="8%"><input type="radio" name="english" value="Don't know this language"></td>
		        </tr>
		      </table>
				</form>
		      </div>
					<br>
					<div class="tick">
					<form action="">
		      <table>
		        <tr>
		        <td width="8%"><label for="name" class="label"style="font-size:25px;margin:0px 55px 0px 0px;font-weight: normal;text-align:left">Malay</label></td>
		        <td width="8%"><input type="radio" name="english" value="excellent"></td>
		        <td width="8%"><input type="radio" name="english" value="Good"></td>
		        <td width="8%"><input type="radio" name="english" value="Fair" ></td>
		        <td width="8%"><input type="radio" name="english" value="Poor" ></td>
		        <td width="8%"><input type="radio" name="english" value="Very Poor"></td>
		        <td width="8%"><input type="radio" name="english" value="Don't know this language"></td>
		        </tr>
		      </table>
		 			</form>
		      </div>
					<br>
					<div class="tick">
						<form>
					<table>
						<tr>
						<td width="8%"><label for="name" class="label"style="font-size:25px;margin:0px 18px 0px 0px;font-weight: normal;text-align:left">Mandarin</label></td>
						<td width="8%"><input type="radio" name="english" value="excellent"></td>
						<td width="8%"><input type="radio" name="english" value="Good"></td>
						<td width="8%"><input type="radio" name="english" value="Fair" ></td>
						<td width="8%"><input type="radio" name="english" value="Poor" ></td>
						<td width="8%"><input type="radio" name="english" value="Very Poor"></td>
						<td width="8%"><input type="radio" name="english" value="Don't know this language"></td>
						</tr>
					</table>
				</form>
					</div>
					<br>
					<div class="tick">
					<table>
						<tr>
						<td width="8%"><label for="name" class="label"style="font-size:25px;margin:0px 67px 0px 0px;font-weight: normal;text-align:left">Hindi</label></td>
						<td width="8%"><input type="radio" name="english" value="excellent"></td>
						<td width="8%"><input type="radio" name="english" value="Good"></td>
						<td width="8%"><input type="radio" name="english" value="Fair" ></td>
						<td width="8%"><input type="radio" name="english" value="Poor" ></td>
						<td width="8%"><input type="radio" name="english" value="Very Poor"></td>
						<td width="8%"><input type="radio" name="english" value="Don't know this language"></td>
						</tr>
					</table>
					</div>
					<div class="group">
					<label for="age" class="label" style="font-size:25px">Other Languages</label>
					<input id="age" type="text" class="input">
					</div>
		  </div>
				<div class ="group">
					<table>
					 <tr>
						 <th width="8%">Expert</th>
						 <th width="8%">Intermediate</th>
						 <th width="8%">Beginner</th>
						 <th width="8%">Don't Know This Skill</th>
					 </tr>
				 </table>
				  <label for="skills" class="label" style="font-size: 30px;margin:20px 0px 10px 100px;font-weight: normal; text-align: left;">Microsoft</label>
					<br>
					<br>
					<div class="tick1">
					<form action="">
					<table>
						<tr>
						<td width="10%"><label for="name" class="label"style="font-size:25px;margin:0px 40px 0px 0px;font-weight: normal;text-align:left">Word</label></td>
						<td width="10%"><input type="radio" name="english" value="expert"></td>
						<td width="10%"><input type="radio" name="english" value="intermediate"></td>
						<td width="10%"><input type="radio" name="english" value="beggine" ></td>
						<td width="10%"><input type="radio" name="english" value="Don't Know This Skill" ></td>
						</tr>
					</table>
				</form>
					</div>
					<br>
					<div class="tick1">
					<form action="">
					<table>
						<tr>
						<td width="10%"><label for="name" class="label"style="font-size:25px;margin:0px 40px 0px 0px;font-weight: normal;text-align:left">Excel</label></td>
						<td width="10%"><input type="radio" name="english" value="expert"></td>
						<td width="10%"><input type="radio" name="english" value="intermediate"></td>
						<td width="10%"><input type="radio" name="english" value="beggine" ></td>
						<td width="10%"><input type="radio" name="english" value="Don't Know This Skill" ></td>
						</tr>
					</table>
				</form>
					</div>
					<br>
					<div class="tick1">
					<form action="">
					<table>
						<tr>
						<td width="10%"><label for="name" class="label"style="font-size:25px;margin:0px 31px 0px 0px;font-weight: normal;text-align:left">Power<br><br>Point</label></td>
						<td width="10%"><input type="radio" name="english" value="expert"></td>
						<td width="10%"><input type="radio" name="english" value="intermediate"></td>
						<td width="10%"><input type="radio" name="english" value="beggine" ></td>
						<td width="10%"><input type="radio" name="english" value="Don't Know This Skill" ></td>
						</tr>
					</table>
				</form>
					</div>
					<label for="skills" class="label" style="font-size: 30px;margin:20px 0px 10px 100px;font-weight: normal; text-align: left;">Programming</label>
					<br>
					<br>
					<div class="tick1">
					<form action="">
					<table>
						<tr>
						<td width="10%"><label for="name" class="label"style="font-size:25px;margin:0px 60px 0px 0px;font-weight: normal;text-align:left">C++</label></td>
						<td width="10%"><input type="radio" name="english" value="expert"></td>
						<td width="10%"><input type="radio" name="english" value="intermediate"></td>
						<td width="10%"><input type="radio" name="english" value="beggine" ></td>
						<td width="10%"><input type="radio" name="english" value="Don't Know This Skill" ></td>
						</tr>
					</table>
				</form>
					</div>
					<br>
					<div class="tick1">
					<form action="">
					<table>
						<tr>
						<td width="8%"><label for="name" class="label"style="font-size:25px;margin:0px 5px 0px 0px;font-weight: normal;text-align:left">JavaScript</label></td>
						<td width="10%"><input type="radio" name="english" value="expert"></td>
						<td width="10%"><input type="radio" name="english" value="intermediate"></td>
						<td width="10%"><input type="radio" name="english" value="beggine" ></td>
						<td width="10%"><input type="radio" name="english" value="Don't Know This Skill" ></td>
						</tr>
					</table>
				</form>
					</div>
					<br>
					<div class="tick1">
					<form action="">
					<table>
						<tr>
						<td width="10%"><label for="name" class="label"style="font-size:25px;margin:0px 30px 0px 0px;font-weight: normal;text-align:left">Phyton</label></td>
						<td width="10%"><input type="radio" name="english" value="expert"></td>
						<td width="10%"><input type="radio" name="english" value="intermediate"></td>
						<td width="10%"><input type="radio" name="english" value="beggine" ></td>
						<td width="10%"><input type="radio" name="english" value="Don't Know This Skill" ></td>
						</tr>
					</table>
				</form>
					</div>
					<br>
					<div class="tick1">
					<form action="">
					<table>
						<tr>
						<td width="10%"><label for="name" class="label"style="font-size:25px;margin:0px 63px 0px 0px;font-weight: normal;text-align:left">Php</label></td>
						<td width="10%"><input type="radio" name="english" value="expert"></td>
						<td width="10%"><input type="radio" name="english" value="intermediate"></td>
						<td width="10%"><input type="radio" name="english" value="beggine" ></td>
						<td width="10%"><input type="radio" name="english" value="Don't Know This Skill" ></td>
						</tr>
					</table>
				</form>
					</div>
					<br>
					<div class="tick1">
					<form action="">
					<table>
						<tr>
						<td width="10%"><label for="name" class="label"style="font-size:25px;margin:0px 57px 0px 0px;font-weight: normal;text-align:left">SQL</label></td>
						<td width="10%"><input type="radio" name="english" value="expert"></td>
						<td width="10%"><input type="radio" name="english" value="intermediate"></td>
						<td width="10%"><input type="radio" name="english" value="beggine" ></td>
						<td width="10%"><input type="radio" name="english" value="Don't Know This Skill" ></td>
						</tr>
					</table>
				</form>
					</div>
					<label for="skills" class="label" style="font-size: 30px;margin:20px 0px 10px 100px;font-weight: normal; text-align: left;">Design</label>
				 <br>
				 <br>
				 <div class="tick1">
				 <form action="">
				 <table>
					 <tr>
					 <td width="8%"><label for="name" class="label"style="font-size:25px;margin:0px 0px 0px 0px;font-weight: normal;text-align:left">Phototshop</label></td>
					 <td width="10%"><input type="radio" name="english" value="expert"></td>
					 <td width="10%"><input type="radio" name="english" value="intermediate"></td>
					 <td width="10%"><input type="radio" name="english" value="beggine" ></td>
					 <td width="10%"><input type="radio" name="english" value="Don't Know This Skill" ></td>
					 </tr>
				 </table>
			 </form>
				 </div>
				 <br>
				 <div class="tick1">
				 <form action="">
				 <table>
					 <tr>
					 <td width="10%"><label for="name" class="label"style="font-size:25px;margin:0px 1px 0px 0px;font-weight: normal;text-align:left">Illustrartor</label></td>
					 <td width="10%"><input type="radio" name="english" value="expert"></td>
					 <td width="10%"><input type="radio" name="english" value="intermediate"></td>
					 <td width="10%"><input type="radio" name="english" value="beggine" ></td>
					 <td width="10%"><input type="radio" name="english" value="Don't Know This Skill" ></td>
					 </tr>
				 </table>
			 </form>
				 </div>
				 <br>
				 <div class="tick1">
				 <form action="">
				 <table>
					 <tr>
					 <td width="6%"><label for="name" class="label"style="font-size:25px;margin:0px 3px 0px 0px;font-weight: normal;text-align:left">PremiumPro</label></td>
					 <td width="10%"><input type="radio" name="english" value="expert"></td>
					 <td width="10%"><input type="radio" name="english" value="intermediate"></td>
					 <td width="10%"><input type="radio" name="english" value="beggine" ></td>
					 <td width="10%"><input type="radio" name="english" value="Don't Know This Skill" ></td>
					 </tr>
				 </table>
			 </form>
				 </div>
				 <br>
				 <label for="skills" class="label" style="font-size: 30px;margin:20px 0px 10px 100px;font-weight: normal; text-align: left;">Engineering Design</label>
				<br>
				<br>
				<div class="tick1">
				<form action="">
				<table>
					<tr>
					<td width="8%"><label for="name" class="label"style="font-size:25px;margin:0px 30px 0px 0px;font-weight: normal;text-align:left">AutoCad</label></td>
					<td width="10%"><input type="radio" name="english" value="expert"></td>
					<td width="10%"><input type="radio" name="english" value="intermediate"></td>
					<td width="10%"><input type="radio" name="english" value="beggine" ></td>
					<td width="10%"><input type="radio" name="english" value="Don't Know This Skill" ></td>
					</tr>
				</table>
			</form>
				</div>
				<br>
				<div class="tick1">
				<form action="">
				<table>
					<tr>
					<td width="8%"><label for="name" class="label"style="font-size:25px;margin:0px 1px 0px 0px;font-weight: normal;text-align:left">SolidWorks</label></td>
					<td width="10%"><input type="radio" name="english" value="expert"></td>
					<td width="10%"><input type="radio" name="english" value="intermediate"></td>
					<td width="10%"><input type="radio" name="english" value="beggine" ></td>
					<td width="10%"><input type="radio" name="english" value="Don't Know This Skill" ></td>
					</tr>
				</table>
			</form>
				</div>
				<br>
				<label for="skills" class="label" style="font-size: 30px;margin:20px 0px 10px 100px;font-weight: normal; text-align: left;">Others</label>
				<br>
				<div class="tick1">
				<form action="">
				<table>
					<tr>
					<td width="8%"><label for="name" class="label"style="font-size:25px;margin:0px 59px 0px 0px;font-weight: normal;text-align:left">Fund<br><br>Rising</label></td>
					<td width="10%"><input type="radio" name="english" value="expert"></td>
					<td width="10%"><input type="radio" name="english" value="intermediate"></td>
					<td width="10%"><input type="radio" name="english" value="beggine" ></td>
					<td width="10%"><input type="radio" name="english" value="Don't Know This Skill" ></td>
					</tr>
				</table>
			</form>
				</div>
				<br>
				<br>
			 <div class="tick1">
			 <form action="">
			 <table>
				 <tr>
				 <td width="8%"><label for="name" class="label"style="font-size:25px;margin:0px 28px 0px 0px;font-weight: normal;text-align:left">Branding</label></td>
				 <td width="10%"><input type="radio" name="english" value="expert"></td>
				 <td width="10%"><input type="radio" name="english" value="intermediate"></td>
				 <td width="10%"><input type="radio" name="english" value="beggine" ></td>
				 <td width="10%"><input type="radio" name="english" value="Don't Know This Skill" ></td>
				 </tr>
			 </table>
		 </form>
			 </div>
			 </div>
			 <br>
			 <br>

			 <button type="cancel" onClick="location.href='/'"class="cancelbtn" style="background-color: 	#CD5C5C;
			 color: white;
			 width:300px;
			 height:60px;
			 font-size:30px;
			 margin-right:100px;
			 float:right;
			 font-family: Arial, Helvetica, sans-serif">Cancel</button>




			</div>
		</div>
	</div>
</div>
</div>

@endsection
