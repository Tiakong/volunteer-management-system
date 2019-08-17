@extends('event.master', ['title'=>'Volunteers\' Enrollment'])
@section('content')

<table class='table table-bordered table-striped'>
	<col width="5%">
	<col width="18%">
	<col width="5%">
	<col width="15%">
	<col width="15%">
	<col width="9%">
	<col width="28%">
	<col width="10%">
	<thead class='thead-dark'>
        <tr>
            <th>No.</th>
            <th>Name</th>
            <th>Gender</th>
            <th>Phone Number</th>
            <th>Email</th>
            <th>Serve Hour</th>
            <th>Remark</th>
            <th>Status</th>
        </tr>
    </thead>
	@if(count($volunteers)>0)
	<tbody>
        @foreach($volunteers as $volunteer)
        <tr>
            <td>{{$loop->index+1}}</td>
            <td>{{$volunteer->name}}</td>
            <td class='text-center'>{{$volunteer->gender}}</td>
            <td>{{$volunteer->contact_no}}</td>
            <td>{{$volunteer->email}}</td>
            <td class='text-center'>{{$volunteer->serve_hour}}</td>
            <td>{{$volunteer->event_remark}}</td>
            <td class='text-center'>{{$volunteer->status}}</td>
        </tr>
        @endforeach
	</tbody>
	@else
	<tr>
		<td colspan='8'>No volunteers had registered this event yet.</td>
	</tr>
	@endif
</table>

<div class='form-group row'>
	<div class='p-3'>
		<a href="{{route('volunteer_event.create',['id'=>$eid])}}">
			<button class="btn btn-lg btn-block btn-success"><i class='fa fa-edit'></i><b> Edit</b></button>
		</a>
	</div>
	<div class='p-3'>
		<a href="{{route('event.show-detail',['id'=>$eid])}}">
			<button class="btn btn-lg btn-block btn-primary"><i class='fa fa-reply'></i><b> Back</b></button>
		</a>
	</div>
</div>


<script>
var msg = '{{Session::get('alert')}}';
var exist = '{{Session::has('alert')}}';
if(exist){
	alert(msg);
}



</script>

@endsection
