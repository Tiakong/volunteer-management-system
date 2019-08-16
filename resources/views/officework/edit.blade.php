<?php
use App\Common;
?>
@extends('officework.master', ['title'=>'Edit Voluntary Administrative Work'])

@section('content')
<div class="'col-sm-12 text-center">
	<br/>
	@include('common.show-error')
	<br/>
	<form name='submitForm' class="border border-light p-5" method="post" action="{{route('officework.update',$officework->oid)}}">
		{{csrf_field()}}
		<input class="form-control mb-4"type="hidden" name="_method" value="PATCH" />
		<div class="form-group row">
			<div class='col-sm-3 p-2'>
				{!! Form::label('officework-description', 'Description', [
					'class' => 'control-label',
				]) !!}
				<span class='required'>*</span>
			</div>
			<div class="col-sm-9">
				<textarea type="text" name="description" class="form-control mb-4" placeholder="Voluntary Administrative Work Description" rows='6'>{{$officework->description}}</textarea>
			</div>
		</div>
		<div class="form-group row">
			<div class='col-sm-3 p-2'>
				{!! Form::label('officework-serve-hour', 'Serve Hour', [
					'class' => 'control-label',
				]) !!}
				<span class='required'>*</span>
			</div>
			<div class="col-sm-9">
				<input type="text" name="serve_hour" class="form-control mb-4" placeholder="Eg: 3.5" value="{{$officework->serve_hour}}"/>
			</div>
		</div>
	</form>
	<div class="border border-light p-3 text-center">
		<h3>Volunteer list</h3>
		<div class="text-left p-3">
			<table id="volunteer_list" class="table table-hover table-striped table-bordered">
				<col width="20%">
				<col width="30%">
				<col width="35%">
				<col width="15%">
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Remark (Optional)</th>
					<th></th>
				</tr>
			</table>
		</div>
		<div class="form-group row p-2">
			<div class='col-sm-12'>
				{!! Form::label('search-volunteer', 'Search Volunteer', [
					'class' => 'control-label col-sm-3',
				]) !!}
				<input type="text" id="inputVolunteerName" placeholder="Volunteer Name (Enter at least 3 characters)" class='col-sm-8'/>
				
			</div>
		</div>
		@include('common.volunteer-name-list')
	</div>
	<button onclick="Submit()" class="btn btn-lg btn-block btn-primary"><b>Submit</b></button>
</div>

<script>
var inputVolunteerName = document.getElementById("inputVolunteerName");

var volunteer_list = [];
SendRequest(
	"<?php echo route('query.VO_getVolunteers'); ?>",
	{'oid':"<?php echo $officework->oid?>"},
	true,
	(list)=>{list.forEach((v)=>{AddToVolunteerList(v)})}
)

inputVolunteerName.oninput = function(){
	SendRequest(
		"<?php echo route('query.searchVolByName'); ?>", //url
		{'name':this.value.trim()}, 	//data
		this.value.trim().length>=3, 	//condition to send request
		DisplayVolunteerNameList,		//callback function
		this, 							//arguments for callback function
		AddToVolunteerList				//arguments for callback function
	)
};

function Submit()
{
	if(volunteer_list.length>0)
	{
		const hiddenInput = document.createElement("input");
		hiddenInput.type = "hidden";
		hiddenInput.name = "volunteerList";
		hiddenInput.value = JSON.stringify(volunteer_list.reduce((a,v)=>{
			var remark = $('#'+v['id']+'-remark').get(0).value;
			v['remark'] = !!remark?remark.trim():"";
			a.push(v);
			return a;
		}, []));
		document.submitForm.appendChild(hiddenInput);
	}
	
	document.submitForm.submit();
}

function AddToVolunteerList(volunteer)
{
	const name = volunteer['name'];
	const id = volunteer['id'];
	
	if(!volunteer_list.find(v=>{return v['id']==id }))
	{
		volunteer_list.push(volunteer);
		//Add table row
		var table = document.getElementById("volunteer_list");
		var tr = document.createElement("tr");
		var td = document.createElement('td');
		td.appendChild(document.createTextNode(id));
		tr.appendChild(td);
		td = document.createElement('td');
		td.appendChild(document.createTextNode(name));
		tr.appendChild(td);
		td = document.createElement('td');
		var inp = document.createElement('input');
		inp.id=id+'-remark';
		inp.type="text";
		inp.style.width = '100%';
		inp.classList.add('form-control');
		inp.value = volunteer['remark']?volunteer['remark']:"";
		td.appendChild(inp);
		tr.appendChild(td);
		td = document.createElement('td');
		var rmbtn = document.createElement('button');
		rmbtn.onclick = ()=>{
			table.removeChild(tr);
			volunteer_list.splice(volunteer_list.indexOf(volunteer), 1);
		};
		rmbtn.style.width = '100%';
		rmbtn.innerHTML = "Remove";
		rmbtn.classList.add("btn");
		rmbtn.classList.add("btn-danger");
		td.appendChild(rmbtn);
		tr.appendChild(td);
		table.appendChild(tr);
	}
	inputVolunteerName.value = '';
}
</script>

@endsection
