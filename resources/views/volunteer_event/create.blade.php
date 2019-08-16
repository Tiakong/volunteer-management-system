@extends('event.master', ['title'=>'Volunteer Details'])
@section('content')
<div class="container box">
   <h3 align="center" style="margin-top:50px;">Search Volunteer</h3><br />
   <div class="panel panel-default">
    <div class="panel-heading" style="margin-bottom:10px;">Search Volunteer's Name / IC</div>
    <div class="panel-body">
     <div class="form-group">
      <input type="text" name="search" id="search" class="form-control" placeholder="Volunteer's name or ic here" />
     </div>
     <div class="table-responsive">
      <h3 align="center">Total Data : <span id="total_records"></span></h3>
      <table class="table table-striped table-bordered">
       <thead>
        <tr>
         <th>Volunteer Name</th>
         <th>IC/Passport</th>
         <th>Gender</th>
         <th>Contact Number</th>
         <th>Email Address</th>
         <th>Action</th>
        </tr>
       </thead>
       <tbody>

       </tbody>
      </table>
     </div>
    </div>    
   </div>
  </div>
 </body>
</html>

<script>
$(document).ready(function(){

 fetch_customer_data();

 function fetch_customer_data(query = ''){
  $.ajax({
   url:"{{ route('volunteer_event.action')}}",
   method:'GET',
   data:{query:query},
   dataType:'json',
   success:function(data)
   {
    $('tbody').html(data.table_data);
    $('#total_records').text(data.total_data);
    var action_route = "{{ route('volunteer_event.update',['id'=>$eid]) }}";
    var myform = document.getElementsByClassName("myForm");
    var i;
      for (i = 0; i < myform.length; i++) { 
         myform[i].action = action_route;
      }
      $('.myForm').prepend('<input name="_token" type="hidden" id="_token" value="{{ csrf_token() }}" />');
   }
  })
  
 }


 $(document).on('keyup', '#search', function(){
  var query = $(this).val();
  fetch_customer_data(query);
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
