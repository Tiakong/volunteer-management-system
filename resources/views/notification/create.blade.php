<?php
use App\Common;
?>
@extends('notification.master', ['title'=>'Send Notification'])

@section('content')
<div class="text-center col-sm-12">
	<br/>
	@include('common.show-error')
	<br/>
	<div class='text-center'>
		<a href="{{route('notification.index')}}"><button class='btn btn-primary'>Back</button></a>
	</div>
	<form name='submitForm' class="text-right border border-light p-3" method="post" action="{{url('notification/create')}}" accept-charset="UTF-8">
		{{csrf_field()}}
		<div class="form-group row">
			<div class='col-sm-2 p-2'>
				{!! Form::label('notification-tite', 'Title', [
					'class' => 'control-label',
				]) !!}
				<span class='required'>*</span>
			</div>
			<div class="col-sm-10">
				<input type="text" name="title" class="form-control mb-4" placeholder="Notification Title" />
			</div>
		</div>
		<div class="form-group row">
			<div class='col-sm-2 p-2'>
				{!! Form::label('notification-description', 'Description', [
					'class' => 'control-label',
				]) !!}
				<span class='required'>*</span>
			</div>
			<div class="col-sm-10">
				<textarea id='description' type="text" name="description" class="form-control mb-4" placeholder="Notification Description" rows='6'></textarea>
			</div>
		</div>
		<div class="form-group row">
			<div class='col-sm-2 p-2'>
				{!! Form::label('category-label', 'Category', [
					'class' => 'control-label',
				]) !!}
				<span class='required'>*</span>
			</div>
			<div class="col-sm-10">
				{!! Form::select('category', Common::$NotificationCategory, 1, [
					'id'	=> 'preset',
					'name'	=> 'category',
					'class' => 'form-control form-control-lg',
					'onchange' => 'SetDescription(this)',
				]) !!}
			</div>
		</div>
		<div class="form-group row" style='margin-left:120px'>
			<input name='url-link' type='text' style='margin:0 4px;' class='col-sm-6' placeholder='URL Link'/>
			<input name='url-title' type='text' style='margin:0 4px;' class='col-sm-3' placeholder='Title of the link'/>
			<input onclick='InsertLink(this)' type='button' style='margin:0 4px;' class='btn btn-primary' value='Insert Link' />
			<a id='preview-link' class='p-2' href="" target="_blank"></a>
		</div>
		<div class="form-group row" style='margin-left:120px'>
		<div id='radioSelection' class="border border-light p-3">
			<span class='required'>*</span>
			<div id='notifType' class="form-group col-sm-12">
				<div class="radio-panel form-group row" >
					{!! Form::radio('type', 1, false) !!}
					<label>Broadcast this notification</label>
				</div>
				<div id='defaultRadio' class="radio-panel form-group row">
					{!! Form::radio('type', 2, true) !!}
					<label>Send to all volunteers</label>
				</div>
				<div id='selection3' class="radio-panel form-group row" >
					{!! Form::radio('type', 3, false) !!}
					<label>Specify volunteer</label>
				</div>
				<div id='volCriteria' hidden class="text-center">
					<button type="button" title='Pop up search tab' class='btn btn-primary'><b>Search Volunteer</b></button>
				</div>
			</div>
		</div>
		</div>
		<div class="form-group row">
			<div class='col-sm-2 p-2'>
				{!! Form::label('employee-name', 'Created by', [
					'class' => 'control-label',
				]) !!}
				<span class='required'>*</span>
			</div>
			<div class="col-sm-5">
				<input type="text" name="created_by" class="form-control mb-4" placeholder="Employee name/nickname" />
			</div>
		</div>
	</form>
	<button class="btn btn-lg btn-block btn-primary" onclick='SubmitForm()' ><b>Submit</b></button>
	<button class="btn btn-lg btn-block btn-primary" onclick="CopyEmailAddress()"><b>Copy Email Addresses</b></button>
</div>

<script>
var HasCopyEmail = false;

$('.radio-panel').click(function(){
	SelectRadio(this);
});
SelectRadio($('#defaultRadio').get(0));

function InsertLink(btn)
{
	var urlLink = $('input[name="url-link"]').get(0).value;
	var urlTitle = $('input[name="url-title"]').get(0).value;
	var description = $('textarea[name="description"]').get(0);
	var preview_link = $('#preview-link').get(0);
	description.value += '<a href="'+urlLink+'" target="_blank">' + urlTitle + '</a>';
	
	preview_link.href = urlLink;
	preview_link.innerHTML = urlTitle;
}

function SelectRadio(dom)
{
	dom.parentNode.querySelectorAll('div').forEach(e=>e.classList.remove('select'));
	var radioSelection = document.getElementById('radioSelection');
	radioSelection.querySelectorAll("input[type='radio']").forEach(e=>{e.parentElement.classList.remove('bg-info');});
	dom.querySelector("input[type='radio']").checked = true;
	dom.classList.add('select');
	document.getElementById('volCriteria').hidden = !(dom.id=="selection3");
}

function CopyEmailAddress()
{
	var str = "testutar@1utar.my testutar2@1utar.my";
	HasCopyEmail = true;
	const el = document.createElement('textarea');
	el.value = str;
	document.body.appendChild(el);
	el.select();
	document.execCommand('copy');
	document.body.removeChild(el);
	
	alert("2 email addresses copied.\nPress ctrl+v to paste the email addresses.");
}

function SubmitForm()
{
	var str = "Confirm sending notifications?" + (HasCopyEmail?'':'\nYou have not yet copy the email address.');
	if( confirm(str) )
	{
		document.submitForm.submit();
	}
}

function setDescription(select)
{
	
}
</script>
@endsection