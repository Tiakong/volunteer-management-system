<?php

use App\Common;

 ?>

 
 <?php $__env->startSection('content'); ?>


<div class="program-form-container"> 

    <ul class="nav nav-tabs">
        <li><a data-toggle="tab" id="1st_quater" href="">January - March</a></li>
        <li><a data-toggle="tab" id="2nd_quater" href="">April - June</a></li>
        <li><a data-toggle="tab" id="3rd_quater" href="">July - September</a></li>
        <li><a data-toggle="tab" id="4th_quater" href="">October - December</a></li>
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
url:"<?php echo e(route('programme.select-tab')); ?>",
method:'GET',
data:{query:page_id},
dataType:'json',
success:function(data)
{
$('#page_details').html(data.table_data);  
var i;
var redirect_route = "<?php echo e(route('programme.show')); ?>";
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

<?php echo $__env->make('programme.master', ['title'=>'View All Programme'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>