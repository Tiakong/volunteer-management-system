<?php
use App\Common;
?>
@extends('notification.master', ['title'=>'Edit Notification'])

@section('content')
<div class='col-sm-12 text-center'>
	<br/>
	@include('common.show-error')
	<br/>
	<a href="{{route('notification.show', $notification->nid)}}">
		<button class='btn btn-primary'><b>Back</b></button>
	</a>
	<form name='submitForm' class="text-right border border-light p-3" method="post" action="{{route('notification.update', $notification->nid)}}">
		{{csrf_field()}}
		<input class="form-control mb-4"type="hidden" name="_method" value="PATCH" />
		<div class="form-group row">
			<div class='col-sm-3 p-2'>
				{!! Form::label('notification-tite', 'Title', [
					'class' => 'control-label',
				]) !!}
				<span class='required'>*</span>
			</div>
			<div class="col-sm-9">
				<input type="text" name="title" value="{{$notification->title}}" class="form-control mb-4" placeholder="Notification Title" />
			</div>
		</div>
		<div class="form-group row">
			<div class='col-sm-3 p-2'>
				{!! Form::label('notification-description', 'Description', [
					'class' => 'control-label',
				]) !!}
				<span class='required'>*</span>
			</div>
			<div class="col-sm-9">
				<textarea type="text" name="description" class="form-control mb-4" placeholder="Notification Description" rows='6'>{{$notification->description}}</textarea>
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
				{!! Form::select('category', Common::$NotificationCategory, $notification->category, [
					'id'	=> 'preset',
					'name'	=> 'category',
					'class' => 'form-control form-control-lg',
					'onchange' => 'SetDescription(this)',
				]) !!}
			</div>
		</div>
		<div class="form-group row">
			<input name='url-link' type='text' style='margin:0 4px;' class='col-sm-6' placeholder='URL Link'/>
			<input name='url-title' type='text' style='margin:0 4px;' class='col-sm-3' placeholder='Title of the link'/>
			<input onclick='InsertLink(this)' type='button' style='margin:0 4px;' class='btn btn-primary' value='Insert Link' />
			<a id='preview-link' class='p-2' href="" target="_blank"></a>
		</div>
	</form>
	<button onclick='SubmitForm()' class="btn btn-lg btn-block btn-primary"><b>Submit</b></button>
</div>

<script>

function setDescription(select)
{
	
}
</script>
@endsection