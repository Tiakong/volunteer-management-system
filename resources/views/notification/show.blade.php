<?php
use App\Common;
?>
@extends('notification.master', ['title'=>'Notification Detail'])

@section('content')
<div class='text-center col-sm-12'>
	<br/>
	@include('common.show-error')
	<br/>
	<a href="{{route('notification.index')}}"><button class='btn btn-primary'>Back</button></a>
	
	<div class='p-5 text-right'>
		<div class="form-group row">
			{!! Form::label('notification-title', 'Title', [
				'class' => 'control-label col-sm-2',
			]) !!}
			<div class='col-sm-10 text-left'>
				<p><?php echo $notification->title?></p>
			</div>
		</div>
		<div class="form-group row">
			{!! Form::label('notification-description', 'Description', [
				'class' => 'control-label col-sm-2',
			]) !!}
			<div class='col-sm-10 text-left'>
				<pre><?php echo $notification->description?>
				</pre>
			</div>
		</div>
		<div class="form-group row">
			{!! Form::label('employee-name', 'Category', [
				'class' => 'control-label col-sm-2',
			]) !!}
			<div class='col-sm-10 text-left'>
				<p>{{Common::$NotificationCategory[$notification->category]}}</p>
			</div>
		</div>
		<div class="form-group row">
			{!! Form::label('employee-name', 'Created by', [
				'class' => 'control-label col-sm-2',
			]) !!}
			<div class='col-sm-10 text-left'>
				<p>{{$notification->created_by}}</p>
			</div>
		</div>
	</div>
	@if(Session::get('authority') == 'admin')
	<a class='p-2' href="{{route('notification.edit', $notification->nid)}}">
		<button class="btn btn-lg btn-block btn-primary"><b>Edit</b></button>
	</a>
	<button onclick='return ConfirmDelete("<?php echo route("notification.delete", $notification->nid)?>")' class="p-2 btn btn-lg btn-block btn-danger"><b>Delete</b></button>
	@endif
</div>

@endsection