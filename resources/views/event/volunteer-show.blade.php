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
          <?php 
          $program_title = Common::GetProgrammes();
          ?>
          <ul class="dropdown-menu">
          @foreach($program_title as $code => $name)
          
          <li>{!! link_to_route('event.volunteer-show',
                      $title = $code,
                      $parameters = [
                          'code' => $code])!!}</li>
          
          @endforeach
          </ul>
      </div>
  </div>

  <div class="event-button-div">
    @if($flag != 0)
      <h2>{{$pname}}</h2>
    @endif
  </div>
</div>     

<ul class="nav nav-tabs">
<li><a data-toggle="tab" id="reserved_event" href="">Reserved Event</a></li>
<li><a data-toggle="tab" id="available_event" href="">Available Event</a></li>
</ul>

<div class="tab-content">
<div id="page_details">
</div>
</div>
</div>

<script>
$(document).ready(function(){

load_page_details('');

function load_page_details(page_id)
{
$.ajax({
url:"{{ route('event.volunteer-select-tab',['code'=>$programme]) }}",
method:'GET',
data:{query:page_id},
dataType:'json',
success:function(data)
{
$('#page_details').html(data.table_data);  
var i;
var redirect_route = "{{ route('event.volunteer-show-detail') }}";
var myform = document.getElementsByClassName("myForm");
for(i=0;i<myform.length;i++){
myform[i].action = redirect_route;
}
$('.myForm').prepend('<input name="_token" type="hidden" id="_token" value="{{ csrf_token() }}" />');  
}
})

}

$('.nav li a').click(function(){
var page_id = $(this).attr("id");

load_page_details(page_id);
});


});
</script>

<script>
var msg = '{{Session::get('alert')}}';
var exist = '{{Session::has('alert')}}';
if(exist){
alert(msg);
}
</script>
@endsection