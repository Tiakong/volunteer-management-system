@extends('event.master', ['title'=>'Edit Volunteers\' Enrollment'])
@section('content')

<form name='submitForm' class="border border-light p-5" method="post" action="{{route('volunteer_event.record', $eid)}}">
	{{csrf_field()}}
	<table class='table table-bordered table-striped table-hovered'>
		<col width="8%">
		<col width="18%">
		<col width="5%">
		<col width="13%">
		<col width="15%">
		<col width="9%">
		<col width="22%">
		<col width="10%">
		<col width="5%">
		<thead class='thead-dark'>
			<tr>
				<th>No.</th>
				<th>Name</th>
				<th>Gender</th>
				<th>Phone Number</th>
				<th>Email</th>
				<th>Serve Hour</th>
				<th>Remark (Optional)</th>
				<th title='Checked if present'>Present</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach($volunteers as $volunteer)
			<tr id="tr-{{$volunteer->vid}}">
				<td>{{$volunteer->id}}</td>
				<td>{{$volunteer->name}}</td>
				<td class='text-center'>{{$volunteer->gender}}</td>
				<td>{{$volunteer->contact_no}}</td>
				<td>{{$volunteer->email}}</td>
				<td class='text-center'>
					<input type='number' id='serve_hour' class='form-control' name='serve_hour|{{$volunteer->vid}}' value="{{$volunteer->serve_hour}}" pattern="\d{1,4}"/>
				</td>
				<td>
					<input type='text' class='form-control' name='remark|{{$volunteer->vid}}' value="{{$volunteer->event_remark}}" />
				</td>
				<td class='text-center' onclick='set(this)'>
				@if($volunteer->status == "present")
					<input type='checkbox' name="status|{{$volunteer->vid}}" readonly checked>
				@else
					<input type='checkbox' name="status|{{$volunteer->vid}}" readonly>
				@endif
				</td>
				<td>
					<button type='button' style='padding:0px 3px;' class='btn btn-danger' onclick="remove('{{$volunteer->vid}}')"><i class='fa fa-close'></i></button>
				</td>
			</tr>
			@endforeach
			
		</tbody>
			<tr style='border:2px solid #aba7a7'>
				<th colspan='5'></th>
				<th>
					<button type='button' style='font-size:12px;padding:2px;margin-bottom:4px;' class='btn btn-success' onclick='setServeHour({{$serve_hour}})'>Set all to {{$serve_hour}}</button>
					<br/>
					<button type='button' style='font-size:12px;padding:2px' class='btn btn-danger' onclick='setServeHour(0.0)'>Set all to 0.0</button>
				</th>
				<th></th>
				<th colspan=2>
					<button type='button' style='font-size:12px;padding:2px;margin-bottom:4px;' class='btn btn-success' onclick="checkall()">Check All</button>
					<br/>
					<button type='button' style='font-size:12px;padding:2px' class='btn btn-danger' onclick="uncheckall()">Uncheck All</button>
				</th>
			</tr>
	</table>

	<fieldset class='form-group'>
		<legend>Add a new volunteer</legend>
		<div class='panel panel-default'>
			<div class='panel-body'>
				<div class='col-sm-12 row'>
					<div class='col-sm-3 p-2'>
						{!! Form::label('search-volunteer', 'Search Volunteer', [
							'class' => 'control-label',
						]) !!}
					</div>
					<div class='col-sm-4'>
						<input type="text" id="inputVolunteerName" placeholder="Volunteer Name (Enter at least 3 characters)" class='form-control'/>
					</div>
				</div>
			</div>
		</div>
		@include('common.volunteer-name-list')
	</fieldset>
	<div class='form-group row'>
		<div class='p-3'>
			<button id='submitFormBtn' type='button' class="btn btn-lg btn-block btn-primary"><i class='fa fa-check-square-o'></i><b> Submit</b></button>
		</div>
		<div class='p-3'>
			<a href="{{route('volunteer_event.index',$eid)}}">
				<button type='button' class="btn btn-lg btn-block btn-primary" onclick='return confirm("Are you sure you want to leave this page?\nAll changes will not be saved.")'><i class='fa fa-reply'></i><b> Back</b></button>
			</a>
		</div>
	</div>
</form>
<script>
function setServeHour(value)
{
	$('input#serve_hour').val(value);
}
function checkall()
{
	$('input[type="checkbox"]').attr('checked', true);
}
function uncheckall()
{
	$('input[type="checkbox"]').attr('checked', false);
}
function set(tr)
{
	$(tr).children('input').attr('checked', function(index, attr){ return !attr})
}

function remove(vid)
{
	SendRequest(
		"<?php echo route('volunteer_event.destroy') ?>",
		{
			'eid':"<?php echo $eid ?>",
			'vid':vid,
		},
		true,
		//Remove table row
		function(vid){
			if(!vid) return;
			$("#tr-"+vid).empty();
		}
	);
}

document.getElementById("inputVolunteerName").oninput = function(){
	SendRequest(
		"<?php echo route('query.searchVolByName'); ?>", //url
		{'name':this.value.trim()}, 	//data
		this.value.trim().length>=3, 	//condition to send request
		DisplayVolunteerNameList,		//callback function
		this,							//argument for callback function
		AddToVolunteerList				//argument for callback function
	)
};

function AddToVolunteerList(volunteer)
{
	SendRequest(
		"<?php echo route('volunteer_event.add')?>",
		{
			'eid':"<?php echo $eid ?>",
			'vid':volunteer['vid'],
			'serve_hour':"<?php echo $serve_hour ?>"
		},
		true,
		AppendToTable
	);
}

function AppendToTable(data)
{
	document.getElementById("inputVolunteerName").value = '';
	
	if(!data)
	{
		alert('This volunteer already exists in the list.');
		return;
	}
	
	$('tbody').first().append(data);
}

document.getElementById('submitFormBtn').onclick = async function(){
	
	/*
	let volunteers = [];
	await SendRequest(
		"<?php echo route('query.VE_getVolunteers')?>",
		{
			'eid':"<?php echo $eid?>"
		},
		true,
		(r=>{volunteers = r;})
	);
	console.log(volunteers);
	*/
	let volunteer_list = {}
	$.map($('input#serve_hour'), function(val){
		console.log(val);
		//Retrieve vid from <input name='serve_hour|.....' />
		let s = val.name.split('|');
		let vid = s[1];
		let serve_hour = $('input[name="serve_hour|'+vid+'"]').first().val();
		serve_hour = (serve_hour==''?'0':serve_hour);
		let remark = $('input[name="remark|'+vid+'"]').first().val();
		remark = (!remark?'':remark);
		let status = $('input[name="status|'+vid+'"]').first().prop('checked')?'present':'';
		
		volunteer_list[vid] = {
			'serve_hour'	:	serve_hour, 
			'event_remark'	:	remark,
			'status'		:	status
		};
	});
	
	const hiddenInput = document.createElement("input");
	hiddenInput.type = "hidden";
	hiddenInput.name = "volunteerList";
	hiddenInput.value = JSON.stringify(volunteer_list);
	document.submitForm.appendChild(hiddenInput);
	document.submitForm.submit();
	
}
</script>
@endsection
