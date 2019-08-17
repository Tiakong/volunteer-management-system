<?php
use App\Common;
?>

@extends('admin.master', ['title'=>'Search Volunteer'])
@section('content')

<style>

.btn-position{
	
	margin-top:20px;
	margin-left:40%;
	margin-bottom:5%;
}

</style>


<div class="search_container">
	<div class="tab-wrapper">
		<nav class="multiple-tabs">
		<div class="tab-selector"></div>
		<a id="clickme" onclick="openTab(event,'Name')" style="padding:15px 99px 15px 99px;">Name</a>
		<a onclick="openTab(event,'Criteria')" style="padding:15px 98px 15px 98px;">Criteria</a>
		<a onclick="openTab(event,'Programme')" style="padding:15px 99px 15px 98px;">Programme</a>
		</nav>
	</div>
	<div class="program-form-container">
		<!-- Search By Name -->
		<div title='Search volunteer by name' id="Name" class="tabcontent text-center p-5">
		<div class='row col-sm-12'>
			{!! Form::label('volunteer-name', 'Volunteer Name', [
				'class' => 'control-label col-sm-3 p-2',
			]) !!}
			<div class="col-sm-9">
				<input id="volunteer_name" type="text" name='volunteerName'  class='form-control' style='width:100%;' placeholder="Enter at least 3 characters"/>
			</div>
		</div>
		@include('common.volunteer-name-list')
		</div>
		
		<!-- Search By Criteria -->
		<div title='Search volunteers that meet a certain combination of skillsets' id="Criteria" class="tabcontent text-left p-5">
		<div class='row col-sm-12'>
			<table class='table'>
				<col width='10%'>
				<col width='10%'>
				<col width='80%'>
				
				<!-- Language -->
				<tr name='Language' class='checkbox-block checkbox-main'>
				<td class='text-center'>
					<input readonly type='checkbox' name="criteria"/>
				</td>
				<th colspan='2'>Language</th>
				</tr>
				@foreach(Common::$Language as $key=>$value)
				<tr hidden name='Language' class='checkbox-block checkbox-sub'>
				<td></td>
				<td class='text-center'>
					<input readonly type='checkbox' id='{{$key}}'/>
				</td>
				<th>{{$value}}</th>
				</tr>
				@endforeach
				
				<!-- Skills -->
				@foreach(Common::$Skillsets as $skill_key => $skill_value)
				<tr name='{{$skill_key}}' class='checkbox-block checkbox-main'>
					<td class='text-center'>
						<input readonly type='checkbox' name="criteria"/> 
					</td>
					<th colspan='2'>{{$skill_key}}</th>
				</tr>
				@foreach($skill_value as $key=>$value)
				<tr name='{{$skill_key}}' hidden class='checkbox-block checkbox-sub'>
					<td></td>
					<td class='text-center'>
						<input readonly type='checkbox' id='{{$key}}'/>
					</td>
					<th>{{$value}}</th>
				</tr>
				@endforeach
				@endforeach	
				
				<!-- Area can contribute -->
				@foreach(Common::$ContributeArea as $skill_key => $skill_value)
				@if(is_array($skill_value))
					<tr name='{{$skill_key}}' class='checkbox-block checkbox-main'>
						<td class='text-center'>
						<input readonly type='checkbox' name="criteria"/>
						</td>
						<th colspan='2'>{{$skill_key}}</th>
					</tr>
					@foreach($skill_value as $key=>$value)
					<tr name='{{$skill_key}}' hidden class='checkbox-block checkbox-sub'>
						<td></td>
						<td class='text-center'>
						<input readonly type='checkbox' id='{{$key}}'/>
						</td>
						<th>{{$value}}</th>
					</tr>
					@endforeach
				@else
					<tr name='{{$skill_value}}' class='checkbox-block checkbox-main'>
						<td class='text-center'>
						<input readonly type='checkbox' id='{{$skill_key}}'/>
						</td>
						<th colspan='2'>{{$skill_value}}</th>
					</tr>
				@endif
				@endforeach	
			</table>
		</div>
		</div>
		
		<!-- Search By programme -->
		<div title='Search volunteers that interest in a certain programme' id="Programme" class="tabcontent text-center p-5">
		<div class='row col-sm-12'>
			{!! Form::label('programme-name', 'Programme', [
				'class' => 'control-label col-sm-3 p-2',
				'onclick' => 'checkStatus()',
			]) !!}
			<div class="col-sm-9">
				{!! Form::select('programme-title', Common::GetProgrammes(), null, [
				'id'	=> 'programme_code',
				'class' => 'form-control form-control-lg',
				'placeholder' => '- ',
				]) !!}
			</div>
		</div>
		</div>
		
		<div>
		<button id='searchBtn' class='btn btn-primary btn-position'>Search</button>
		</div>
	</div>

	<div id='search_result'>
			
		<!-- Volunteer that interested in programme -->
		<table id='search_vp' class='table table-bordered'>
		</table>

		<div class='row col-sm-12' id="notification">
		</div>

		<div class="col-sm-9 text-center text-danger" id="alert_field">

		</div>


	</div>
</div>

<script>
$(document).ready(function(){
	
	const skillsets = JSON.parse('<?php echo json_encode(Common::$SkillsetsShortform) ?>');
	
	$('#searchBtn').click(function(){
		
		var data = {};
		skillsets.forEach(function(e){
			data[e] = $('#'+e).get(0).checked?1:0;
		});
		
		data['name'] = $("#volunteer_name").get(0).value;
		data['code'] = $("#programme_code").get(0).value;
		
		SendRequest(
		"<?php echo route("query.combineSearchQuery");?>",
		data,
		true,
		DisplaySearchResult
		);
	});
	
	$('.checkbox-block').click(function(e){
		var checkbox = $(this).find('input[type="checkbox"]');
		checkbox.prop('checked', !checkbox.prop('checked'));
		$(this).toggleClass('checkbox-block-selected');
	});
	
	$('.checkbox-main').click(function(){
		var subcheckbox = $(this).nextAll('[name="'+$(this).get(0).getAttribute("name")+'"].checkbox-sub');
		subcheckbox.prop('hidden', !subcheckbox.prop('hidden'));
		//Uncheck all sub if main is unchecked
		if(!$(this).prop('hidden'))
		{
		var checkbox = subcheckbox.find('input[type="checkbox"]');
		checkbox.prop('checked', false);
		subcheckbox.removeClass('checkbox-block-selected');
		}
	});
	
	$('#volunteer_name').keyup(function(e){
		var value = this.value;
		SendRequest(
		"<?php echo route('query.searchVolByName'); ?>",
		{'name':value.trim()},
		value.trim().length >= 3,
		DisplayVolunteerNameList,
		this
		);
	});
  
	//Click the default active tab content. 
	//Default tab content is Name
	document.getElementById("clickme").click();
	
	var tabs = $('.multiple-tabs');
	var activeItem = tabs.find('.active');
	var activeWidth = activeItem.innerWidth();
	$(".tab-selector").css({
		"left": activeItem.position.left + "px",
		"width": "295" + "px"
	});

	tabs.on("click","a",function(e){
		e.preventDefault();
		$('.multiple-tabs a').removeClass("active");
		$(this).addClass('active');
		var activeWidth = $(this).innerWidth();
		var itemPos = $(this).position();
		$(".tab-selector").css({
		"left":itemPos.left + "px",
		"width": "295" + "px"
		});
	});
});

function openTab(evt, tabName) {
	var tabcontent = $(".tabcontent");
	tabcontent.css('display', 'none');
	tabcontent.filter('#'+tabName).css('display', 'block');
	$(evt.currentTarget).toggleClass("active");

	//Hide the Result Division
	document.getElementById("search_result").style.display= "none";
	//Clear the Search Name Field
	document.getElementById("volunteer_name").value="";
	//Reset the Select Option 
	$('#programme_code').prop('selectedIndex',0);
	//Reset The Criteria Table
	var input = document.getElementsByName("criteria");
	for (var i = 0;i<input.length;i++)
	{
		if (input[i].checked == true)
		{
		input[i].checked = false;
		input[i].click();
		}
	}


}

var volunteer_name_vid = "";

function DisplaySearchResult(results)
{
		$('#search_vp').empty();
		$('#notification').empty();
		$('#alert_field').empty();
		var result_found = false ;
		volunteer_name_vid = "";

		//Search By Name
		if(results['v'].length>0)
		{
			var header = ["ID","Name","Email","Contact","Race","Status"];
			var volunteer = results['v'];
			var table = document.getElementById("search_vp");
			var tbody = document.createElement("tbody");
			table.appendChild(tbody);
			var tr = document.createElement("tr");
			tbody.appendChild(tr);
			for (var i=0;i<header.length;i++)
			{
				var th = document.createElement("th");
				th.appendChild(document.createTextNode(header[i]));
				tr.appendChild(th);
			}
			var tr = document.createElement("tr");
			tbody.appendChild(tr);
			for(var key in volunteer[0])
			{			
				if(key=="id")
				{
					var td = document.createElement("td");
					td.appendChild(document.createTextNode(volunteer[0].id));
				}
				else if(key=="name")
				{
					var td = document.createElement("td");
					var a = document.createElement("a");
					var url = '{{ route("volunteer.show-by-search", "id") }}';
					url = url.replace('id', volunteer[0].vid);
					a.setAttribute('href',url);
					a.target ='_blank';
					a.innerHTML = volunteer[0].name;
					td.appendChild(a);
				}
				else if(key=="email")
				{
					var td = document.createElement("td");
					td.appendChild(document.createTextNode(volunteer[0].email));
				}
				else if(key=="contact_no")
				{
					var td = document.createElement("td");
					td.appendChild(document.createTextNode(volunteer[0].contact_no));
				}
				else if(key=="race")
				{
					var td = document.createElement("td");
					td.appendChild(document.createTextNode(volunteer[0].race));
				}
				else if (key=="last_active_date")
				{
					//Get Today Date
					var today = new Date();
					var dd = String(today.getDate()).padStart(2, '0');
					var mm = String(today.getMonth() + 1).padStart(2, '0');
					var yyyy = today.getFullYear();
					today = yyyy + '-' + mm + '-' + dd ;
					
					//Calculate the Date Difference Between Today and Last Active Date
					var endDate = Date.parse(today);
					var startDate = Date.parse(volunteer[0].last_active_date);
					var timeDiff = endDate - startDate;
					daysDiff = Math.floor(timeDiff / (1000 * 60 * 60 * 24));
					var status = "Active";

					if (daysDiff>=100)
					{
						status = "Inactive";
					}
					var td = document.createElement("td");
					td.appendChild(document.createTextNode(status));
				}
				tr.appendChild(td);
			}
			//Append Volunteer VID into Array
			volunteer_name_vid = volunteer[0].vid;

			//Create A Label
			var label = document.createElement("label");
			label.innerHTML = "Title";
			document.getElementById("notification").appendChild(label);

			//Create A TextField
			var text_title = document.createElement("input");
			text_title.setAttribute('type','text');
			text_title.className='form-control'
			text_title.id = "title";
			text_title.placeholder = "The title";
			document.getElementById("notification").appendChild(text_title);

			//Create A Label
			var label = document.createElement("label");
			label.innerHTML = "Enter Message";
			document.getElementById("notification").appendChild(label);

			//Create A TextArea
			var textarea = document.createElement("textarea");
			textarea.className='form-control'
			textarea.id = "notification_message";
			textarea.placeholder = "The description of the notification";
			document.getElementById("notification").appendChild(textarea);

			//Create A Label
			var label = document.createElement("label");
			label.innerHTML = "Created By";
			document.getElementById("notification").appendChild(label);

			//Create A TextField
			var text = document.createElement("input");
			text.setAttribute('type','text');
			text.className='form-control'
			text.id = "created_by";
			text.placeholder = "Employee's name or nickname";
			document.getElementById("notification").appendChild(text);

			//Create Send Notification Button
			var x = document.createElement("input");
			x.setAttribute("type", "button");
			x.setAttribute("value", "Send Notification");
			x.className = "btn btn-primary btn-position";
			x.onclick  = function() {
    			Send("Name");
				}
			document.getElementById("notification").appendChild(x);
			result_found = true ;
		}
		
		//Search By Programme
		else if(results['vp']['interested'] !== undefined)
		{		
			if (results['vp']['interested'].length != 0)
			{
			var volunteer_array = [];
			var count = 0;
			var header = ["ID","Name","Email","Contact","Race","Status",""];
			var table = document.getElementById("search_vp");
			var tbody = document.createElement("tbody");
			table.appendChild(tbody);
			var tr = document.createElement("tr");
			tbody.appendChild(tr);
			
			for (var i=0;i<header.length;i++)
			{
				var th = document.createElement("th");
				th.appendChild(document.createTextNode(header[i]));
				tr.appendChild(th);
			}
				for (var key in results['vp']['interested'] )
				{
					var tr = document.createElement("tr");
					for (var i =0;i<7;i++)
					{
						tbody.appendChild(tr);
						var td = document.createElement("td");
						if(i==0)
						{
						td.appendChild(document.createTextNode(results['vp']['interested'][key].id));
						}
						else if(i==1)
						{
						var a = document.createElement("a");
						var url = '{{ route("volunteer.show-by-search", "id") }}';
						url = url.replace('id', results['vp']['interested'][key].vid);
						a.setAttribute('href',url);
						a.target ='_blank';
						a.innerHTML = results['vp']['interested'][key].name;
						td.appendChild(a);
						}
						else if(i==2)
						{
						td.appendChild(document.createTextNode(results['vp']['interested'][key].email));
						}
						else if(i==3)
						{
						td.appendChild(document.createTextNode(results['vp']['interested'][key].contact_no));
						}
						else if(i==4)
						{
						td.appendChild(document.createTextNode(results['vp']['interested'][key].race));
						}
						else if(i==5)
						{
							//Get Today Date
							var today = new Date();
							var dd = String(today.getDate()).padStart(2, '0');
							var mm = String(today.getMonth() + 1).padStart(2, '0');
							var yyyy = today.getFullYear();
							today = yyyy + '-' + mm + '-' + dd ;
							
							//Calculate the Date Difference Between Today and Last Active Date
							var endDate = Date.parse(today);
							var startDate = Date.parse(results['vp']['interested'][key].last_active_date);
							var timeDiff = endDate - startDate;
							daysDiff = Math.floor(timeDiff / (1000 * 60 * 60 * 24));
							var status = "Active";

							if (daysDiff>=100)
							{
								status = "Inactive";
							}
							td.appendChild(document.createTextNode(status));
						}
						else if (i==6)
						{
							var checkbox = document.createElement("input");
							checkbox.setAttribute("type", "checkbox");
							checkbox.value = results['vp']['interested'][key].vid;
							checkbox.name = "VolunteerID";
							td.appendChild(checkbox);
						}
						tr.appendChild(td);
						}
					}
					//Select All Button
					var select_all = document.createElement("input");
					select_all.setAttribute("type", "button");
					select_all.setAttribute("value", "Select All");
					select_all.style.marginRight = "100%" ;
					select_all.style.marginBottom = "30px";
					select_all.style.float = "right";
					select_all.className = "btn btn-primary ";
						select_all.onclick  = function() {
						selectAll();
						}
					document.getElementById("notification").appendChild(select_all);

					//Create A Label
					var label = document.createElement("label");
					label.innerHTML = "Title";
					document.getElementById("notification").appendChild(label);

					//Create A TextField
					var text_title = document.createElement("input");
					text_title.setAttribute('type','text');
					text_title.className='form-control'
					text_title.id = "title";
					text_title.placeholder = "The title";
					document.getElementById("notification").appendChild(text_title);

					//Create A Label
					var label = document.createElement("label");
					label.innerHTML = "Enter Message";
					document.getElementById("notification").appendChild(label);

					//Create A TextArea
					var textarea = document.createElement("textarea");
					textarea.className='form-control'
					textarea.id = "notification_message";
					textarea.placeholder = "The description of the notification";
					document.getElementById("notification").appendChild(textarea);

					//Create A Label
					var label = document.createElement("label");
					label.innerHTML = "Created By";
					document.getElementById("notification").appendChild(label);

					//Create A TextField
					var text = document.createElement("input");
					text.setAttribute('type','text');
					text.className='form-control'
					text.id = "created_by";
					text.placeholder = "Employee's name or nickname";
					document.getElementById("notification").appendChild(text);

					

					//Create Send Notification Button
					var x = document.createElement("input");
					x.setAttribute("type", "button");
					x.setAttribute("value", "Send Notification");
					x.className = "btn btn-primary btn-position";
						x.onclick  = function() {
						Send("Programme");
						}
					document.getElementById("notification").appendChild(x);
					result_found = true ;
				}

		}
		
		else if( $("input:checked").length != 0)
		{		
			if (results['vc'].length != 0)
			{
			var volunteer_array = [];
			var count = 0;
			var header = ["ID","Name","Email","Contact","Race","Status",""];
			var table = document.getElementById("search_vp");
			var tbody = document.createElement("tbody");
			table.appendChild(tbody);
			var tr = document.createElement("tr");
			tbody.appendChild(tr);
			
			for (var i=0;i<header.length;i++)
			{
				var th = document.createElement("th");
				th.appendChild(document.createTextNode(header[i]));
				tr.appendChild(th);
			}
				for (var key in results['vc'] )
				{
					var tr = document.createElement("tr");
					for (var i =0;i<7;i++)
					{
						
						tbody.appendChild(tr);
						var td = document.createElement("td");
						
						if(i==0)
						{
						td.appendChild(document.createTextNode(results['vc'][key].id));
						}
						else if(i==1)
						{
							var a = document.createElement("a");
							var url = '{{ route("volunteer.show-by-search", "id") }}';
							url = url.replace('id', results['vc'][key].vid);
							a.setAttribute('href',url);
							a.target ='_blank';
							a.innerHTML = results['vc'][key].name;
						td.appendChild(a);
						}
						else if(i==2)
						{
						td.appendChild(document.createTextNode(results['vc'][key].email));
						}
						else if(i==3)
						{
						td.appendChild(document.createTextNode(results['vc'][key].contact_no));
						}
						else if(i==4)
						{
						td.appendChild(document.createTextNode(results['vc'][key].race));
						}
						else if (i==5)
						{
							//Get Today Date
							var today = new Date();
							var dd = String(today.getDate()).padStart(2, '0');
							var mm = String(today.getMonth() + 1).padStart(2, '0');
							var yyyy = today.getFullYear();
							today = yyyy + '-' + mm + '-' + dd ;
							
							//Calculate the Date Difference Between Today and Last Active Date
							var endDate = Date.parse(today);
							var startDate = Date.parse(results['vc'][key].last_active_date);
							var timeDiff = endDate - startDate;
							daysDiff = Math.floor(timeDiff / (1000 * 60 * 60 * 24));
							var status = "Active";

							if (daysDiff>=100)
							{
								status = "Inactive";
							}
							td.appendChild(document.createTextNode(status));
						}
						else if (i==6)
						{
							var checkbox = document.createElement("input");
							checkbox.setAttribute("type", "checkbox");
							checkbox.value = results['vc'][key].vid;
							checkbox.name = "VolunteerID";
							td.appendChild(checkbox);
						}
						tr.appendChild(td);
						}
				}				
				
				//Select All Button
				var select_all = document.createElement("input");
					select_all.setAttribute("type", "button");
					select_all.setAttribute("value", "Check All");
					select_all.style.marginRight = "100%" ;
					select_all.style.marginBottom = "30px";
					select_all.style.float = "right";
					select_all.className = "btn btn-primary ";
						select_all.onclick  = function() {
						selectAll();
						}
					document.getElementById("notification").appendChild(select_all);

					//Create A Label
					var label = document.createElement("label");
					label.innerHTML = "Title";
					document.getElementById("notification").appendChild(label);

					//Create A TextField
					var text_title = document.createElement("input");
					text_title.setAttribute('type','text');
					text_title.className='form-control'
					text_title.id = "title";
					text_title.placeholder = "The title";
					document.getElementById("notification").appendChild(text_title);
					
				//Create A Label
					var label = document.createElement("label");
					label.innerHTML = "Enter Message";
					document.getElementById("notification").appendChild(label);

					//Create A TextArea
					var textarea = document.createElement("textarea");
					textarea.className='form-control'
					textarea.id = "notification_message";
					textarea.placeholder = "The description of the notification";
					document.getElementById("notification").appendChild(textarea);

					//Create A Label
					var label = document.createElement("label");
					label.innerHTML = "Created By";
					document.getElementById("notification").appendChild(label);

					//Create A TextField
					var text = document.createElement("input");
					text.setAttribute('type','text');
					text.className='form-control'
					text.id = "created_by";
					text.placeholder = "Employee's name or nickname";
					document.getElementById("notification").appendChild(text);

					//Create Send Notification Button
					var x = document.createElement("input");
					x.setAttribute("type", "button");
					x.setAttribute("value", "Send Notification");
					x.className = "btn btn-primary btn-position";
					x.onclick  = function() {
						Send("Criteria");
						}
					document.getElementById("notification").appendChild(x);
					result_found = true ;
		}
		}
		//Preview Alert For No Result
		if (result_found ==false)
		{
			var alert = document.createElement("h2");
			alert.appendChild(document.createTextNode("No Result is Found"));
			document.getElementById("alert_field").appendChild(alert);
		}
		document.getElementById("search_result").style.display= "block";
}

var check_count=0;
function selectAll()
{
	var input = document.getElementsByName("VolunteerID");
	if (check_count == 0)
	{
		for (var i = 0;i<input.length;i++)
		{
		if (input[i].checked == false)
		{
			input[i].checked = true;
			}
		}
		check_count =1 ;
	}
	else
	{
			for (var i = 0;i<input.length;i++)
		{
		if (input[i].checked == true)
		{
			input[i].checked = false;
			}
		}
		check_count = 0;
	}
	}
	



function Send(vid)
{
	//Append Volunteer VID Into Array
	var volunteer = [];
	if (vid == "Name")
	{
		volunteer.push(volunteer_name_vid);
	}
	else
	{
		var volunteer_id = document.getElementsByName("VolunteerID");
		for (var i = 0;i<volunteer_id.length;i++)
		{
			if (volunteer_id[i].checked == true)
			{
				volunteer.push(volunteer_id[i].value);
			}
		}
	}
	
	var title = document.getElementById("title").value;
	var created_by = document.getElementById("created_by").value;
	var message = document.getElementById("notification_message").value;
	if (title!="" && message != "" && volunteer.length !== 0 && created_by !="")
	{
        if (confirm("Make sure that messages entered and volunteers selected are correct,\nonce you proceed after this stage you would not be able to go back and revert this process." + "\n" + "\n" + "Are you sure you want to Proceed?" + "\n" ))
        {
			SendNotification(
		"<?php echo route('notification.send'); ?>", //URL
		3, 											//Type
		title,										//Title
		message,									//description
		1,											//Category
		volunteer,									//Target
		created_by,									//Created By
		1,											//for_volunteer
		1											//For_admin
	);									
	
	alert("Message is Sent Successfully!");
	// document.location.reload(true);
		}
    }
		
	else if (title=="")
	{
		alert("Please enter the title in the box provided");
	}
	else if (message=="")
	{
		alert("Please enter the message in the box provided");
	}
	else if (volunteer.length=== 0)
	{
		alert("Please select at Least one volunteer");
	}
	else if (created_by == "")
	{
		alert("Please fill in created by field");
	}
		

}



</script>
@endsection
