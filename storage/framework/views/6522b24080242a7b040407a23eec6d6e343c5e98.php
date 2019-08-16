<?php $__env->startSection('content'); ?>
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
          <?php $__currentLoopData = $program_title; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          
          <li><?php echo link_to_route('event.volunteer-show',
                      $title = $code,
                      $parameters = [
                          'code' => $code]); ?></li>
          
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
      </div>
  </div>

  <div class="event-button-div">
    <?php if($flag != 0): ?>
      <h2><?php echo e($pname); ?></h2>
    <?php endif; ?>
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
url:"<?php echo e(route('event.volunteer-select-tab',['code'=>$programme])); ?>",
method:'GET',
data:{query:page_id},
dataType:'json',
success:function(data)
{
$('#page_details').html(data.table_data);  
var i;
var redirect_route = "<?php echo e(route('event.volunteer-show-detail')); ?>";
var myform = document.getElementsByClassName("myForm");
for(i=0;i<myform.length;i++){
myform[i].action = redirect_route;
}
$('.myForm').prepend('<input name="_token" type="hidden" id="_token" value="<?php echo e(csrf_token()); ?>" />');  
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
var msg = '<?php echo e(Session::get('alert')); ?>';
var exist = '<?php echo e(Session::has('alert')); ?>';
if(exist){
alert(msg);
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('event.master', ['title'=>'Event Reservation'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>