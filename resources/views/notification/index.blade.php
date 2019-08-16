<?php
use App\Common;
?>
@extends('notification.master', ['title'=>"Your Notifications"])

@section('content')
<div class='text-center col-sm-12'>
	<br/>
	@include('common.show-error')
	<br/>
	@if(Session::get('authority')=='admin')
	<a href='{{route("notification.create")}}'><button class='btn btn-primary'>Send Notification</button></a>
	@endif
	<br/>
	<!--Broadcast Notification-->
	<div class='card text-left' style="height:300px;overflow-y:scroll;overflow-x:hidden;border:1px solid black;margin-top:10px;display:block;">
		<div class='row card-body'>
			<h3 class='text-center' style='margin:0 auto;margin-top:10px;margin-bottom:15px;'>Broadcast Notification</h3>
			<table class="table table-striped table-bordered text-left disable-highlight">
				<col width="5%">
				<col width="70%">
				<col width="25%">
				@foreach($broadcastnotifications as $row)
				<thead class="black white-text notification-title">
					<tr class="{{Common::$NotificationCategory[$row->category]}}">
						<td class='text-center'>{{$loop->index+1}}</td>
						<td>{{$row->title}}</td>
						<td>{{Carbon\Carbon::parse($row->created_at)->format('d M Y')}}</td>
					</tr>
				</thead>
				<tbody class='notification-description'>
					<tr>
						<td colspan=3>
							<pre><?php echo strlen($row->description)>200?substr($row->description,0, 197).'...':$row->description?></pre>
						</td>
					</tr>
					<tr>
						<td colspan=2>Created by {{$row->created_by}}</td>
						<td class='text-center'><a href="{{route('notification.show', $row->nid)}}">See More</a></td>
					</tr>
				</tbody>
				@endforeach
			</table>
		</div>
	</div>
	
	<!--Normal Notification-->
	<div class='p-5 text-left' style='display:block;'>
		{{ $notifications->links('common.pagination') }}
		<table class="notification-table table table-bordered disable-highlight">
			<col width="5%">
			<col width="75%">
			<col width="20%">
			@foreach($notifications as $row)
			<thead class="white-text notification-title">
				<tr class="{{Common::$NotificationCategory[$row->category]}}">
					<td class='text-center'>{{$loop->index+1+($notifications->currentPage()-1)*$notification_per_page}}</td>
					<td>{{$row->title}}</td>
					<td class='text-center'>{{Carbon\Carbon::parse($row->created_at)->format('d M Y')}}</td>
				</tr>
			</thead>
			<tbody class='notification-description'>
				<tr>
					<td colspan=3>
						<pre><?php echo strlen($row->description)>200?substr($row->description,0, 197).'...':$row->description?></pre>
					</td>
				</tr>
				<tr>
					<td colspan=2>Created by {{$row->created_by}}</td>
					<td class='text-center'><a href="{{route('notification.show', $row->nid)}}">See More</a></td>
				</tr>
			</tbody>
			@endforeach
		</table>
		{{ $notifications->links('common.pagination') }}
	</div>
</div>

<script>
$('.notification-title').click(function(){
	$(this).next('.notification-description').toggleClass('row-active');	//$(this).next('.notification-description').slideToggle('fast');
});
function send()
{
	SendNotification(
		"<?php echo route('notification.send'); ?>",
		1,
		'Auto Notification',
		'Auto Notification',
		null,
		0,
		0
	);
}

function SetDescription(dom)
{
	
}
</script>
@endsection

