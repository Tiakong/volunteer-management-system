@extends('event.master', ['title'=>'Event Reservation'])
@section('content')
<?php 
    use App\Common;
?>
<div class="event-form-container">

	<div class="button-div">

	  <div class="program-button-div">
		  <div class="dropdown">
			  <button class="program-button btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Programme
			  </button>
			  <ul class="dropdown-menu">
				<li>
					<a href="{{route('event.index')}}">All</a>
				</li>
			  @foreach(Common::GetProgrammes() as $code => $name)
			  
			  <li>
				  <a href="{{route('event.show', $code)}}">{{ $code }}</a>
			  </li>
			  
			  @endforeach
			  </ul>
		  </div>
	  </div>

	  @if($flag != 0)
	  <div class="event-button-div">
		  <h2>{{$pname}}</h2>
	  </div>
	  @endif
	</div>

	<ul class="nav nav-tabs">
		<li class='active'><a data-toggle="tab" id="reserved_event" href="">Reserved Event</a></li>
		<li><a data-toggle="tab" id="available_event" href="">Available Event</a></li>
		<li><a data-toggle="tab" id="past_events" href="">All Events You've Registered</a></li>
	</ul>

	<div class="tab-content">
		<div id="page_details"></div>
	</div>
</div>

<script>
	function load_page_details(choice)
	{
		SendRequest(
			"<?php echo route('event.select-tab') ?>",
			{
				'query':choice,
				'code':"<?php echo $programme ?>"
			},
			true,
			function(table)
			{
				console.log(table);
			   $('#page_details').html(table);  
			}
		);
	}

$(document).ready(function(){

	load_page_details('reserved_event');

	$('.nav li a').click(function(){
		var choice = $(this).attr("id");
		load_page_details(choice);
	});

});
</script>

<script>
var msg = '{{Session::get("alert")}}';
var exist = '{{Session::has("alert")}}';
if(exist){
alert(msg);
}
</script>
@endsection