<?php
use App\Common;
?>
@extends('officework.master', ['title'=>"Index of Voluntary Administrative Works"])

@section('content')
<div class="col-sm-12 text-center">
	<br/>
	@include('common.show-error')
	<br/>
	
	<button class='btn btn-primary'>
		<strong><a href="{{route('officework.create')}}">Record</a></strong>
	</button>
	
	<br/>
	<div class="form-group p-3">
		<table class="table table-hover table-striped table-bordered">
			<col width="5%">
			<col width="50%">
			<col width="12%">
			<col width="13%">
			<col width="10%">
			<thead class="black white-text">
				<tr>
					<th>No.</th>
					<th>Description</th>
					<th>Serve Hour</th>
					<th>Record Date</th>
					<th></th>
				</tr>
			 </thead>
			 <tbody>
				@foreach($officeworks as $row)
				<tr>
					<td>{{$loop->index+1}}</td>
					<td>{{$row->description}}</td>
					<td>{{$row->serve_hour}}</td>
					<td>{{$row->created_at->format('d M Y')}}</td>
					<td><a href="{{route('officework.show', $row->oid)}}">See More</a></td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection
