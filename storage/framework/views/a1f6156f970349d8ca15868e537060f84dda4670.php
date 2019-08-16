<?php

use App\Common;

 ?>

 
 <?php $__env->startSection('container'); ?>


  <div class ="programme-tab" >
 <!-- <button class="tablinks" onclick="openTab(event,'January')" id="January" >January</button>
 <button class="tablinks" onclick="openTab(event,'February')" id="February">February</button>
 <button class="tablinks" onclick="openTab(event,'March')" id="March">March</button>
 <button class="tablinks" onclick="openTab(event,'April')" id="April">April</button>
 <button class="tablinks" onclick="openTab(event,'May')" id="May">May</button>
 <button class="tablinks" onclick="openTab(event,'June')" id="June">June</button>
 <button class="tablinks" onclick="openTab(event,'July')" id="July">July</button>
 <button class="tablinks" onclick="openTab(event,'August')" id="August">August</button>
 <button class="tablinks" onclick="openTab(event,'September')" id="September">September</button>
 <button class="tablinks" onclick="openTab(event,'October')" id="October">October</button>
 <button class="tablinks" onclick="openTab(event,'November')" id="November">November</button>
 <button class="tablinks" onclick="openTab(event,'December')" id="December">December</button> -->

 <!-- <button class="tablinks" onclick="openTab(event,'January')" id="1" >January</button>
 <button class="tablinks" onclick="openTab(event,'February')" id="2">February</button>
 <button class="tablinks" onclick="openTab(event,'March')" id="3">March</button>
 <button class="tablinks" onclick="openTab(event,'April')" id="4">April</button>
 <button class="tablinks" onclick="openTab(event,'May')" id="5">May</button>
 <button class="tablinks" onclick="openTab(event,'June')" id="6">June</button>
 <button class="tablinks" onclick="openTab(event,'July')" id="7">July</button>
 <button class="tablinks" onclick="openTab(event,'August')" id="8">August</button>
 <button class="tablinks" onclick="openTab(event,'September')" id="9">September</button>
 <button class="tablinks" onclick="openTab(event,'October')" id="10">October</button>
 <button class="tablinks" onclick="openTab(event,'November')" id="11">November</button>
 <button class="tablinks" onclick="openTab(event,'December')" id="12">December</button> -->

 <div class="tab-wrapper">
  <nav class="multiple-tabs">
    <div class="tab-selector"></div>
    <a href="#" class="active" onclick="openTab(event,'December')">January</a>
    <a href="#"  onclick="openTab(event,'December')">February</a>
    <a href="#"  onclick="openTab(event,'December')">March</a>
    <a href="#"  onclick="openTab(event,'December')">April</a>
    <a href="#"  onclick="openTab(event,'December')">May</a>
    <a href="#"  onclick="openTab(event,'December')">June</a>
    <a href="#"  onclick="openTab(event,'December')">July</a>
    <a href="#"  onclick="openTab(event,'December')">August</a>
    <a href="#"  onclick="openTab(event,'December')">September</a>
    <a href="#"  onclick="openTab(event,'December')">October</a>
    <a href="#"  onclick="openTab(event,'December')">November</a>
    <a href="#"  onclick="openTab(event,'December')">December</a>


  </nav>
</div>


   <div class="program-form-container tabcontent" id="contents">

            <div class="program-function-button-div">
                <button class="program-add-button btn btn-success" onclick="window.location='<?php echo e(url("admin/addProgramme")); ?>'">Add New Program</button>
            </div>

            <?php if(count($programme)>0): ?>
            <?php $__currentLoopData = $programme; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $programme): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <div id ="month">

        <div class="program-bar">
            <div class="program-board">
                <table>
                  <col width="300px">
                  <col width="700px">
                  <!-- <col width= 40%> -->

                    <tr>
                        <td>Program Name:</td>
                        <td>
                          <div>
                            <?php echo e($programme->name); ?>

                          </div>
                        </td>
                    </tr>

                    <tr>
                        <td>Program Duration:</td>
                        <td><div>  <?php echo e(Common::$Month[$programme->startmonth]); ?> <?php echo " " ?><?php echo e($programme->startyear); ?>  <?php echo "-" ?>  <?php echo e(Common::$Month[$programme->endmonth]); ?><?php echo " " ?><?php echo e($programme->endyear); ?>

                        </div></td>
                    </tr>
                    <tr>
                        <td>Program Venue:</td>
                        <td>
                          <div>
                            <?php echo e($programme->venue); ?>

                          </div>
                        </td>
                    </tr>

                    <tr>
                      <td></td>
                      <td>

                        <div style="margin-left:20%;">
                        <?php echo link_to_route(
                          'admin.show',
                          $title = 'View More',
                          $parameters = [
                          'pid' => $programme->id,
                          ]
                          ); ?>

                        </div>
                      </td>
                    </tr>
                </table>

            </div>

  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


   </div>

   <?php endif; ?>
 </div>
</div>
 </div>

 <script>
 function openTab(evt, TabName) {
   var i, tabcontent, tablinks;
   tabcontent = document.getElementsByClassName("tabcontent");
   for (i = 0; i < tabcontent.length; i++) {
     tabcontent[i].style.display = "none";
   }
   tablinks = document.getElementsByClassName("tablinks");
   for (i = 0; i < tablinks.length; i++) {
     tablinks[i].className = tablinks[i].className.replace(" active", "");
   }
   document.getElementById("contents").style.display = "block";
   evt.currentTarget.className += " active";

 }
//
//  // function check()
//  // {
//  //   var btn = document.getElementsByTagName("button");
//  //   for(int i =0;i<13;i++)
//  //   {
//  //     if (btn[i].focus()==true)
//  //     {
//  //       return btn[i].id;
//  //       console.log(btn[i].id);
//  //     }
//  //   }
//  //
//  // }
//
// window.onload = function(){
//
//   // var month = new Array();
//   // month[0] = "January";
//   // month[1] = "February";
//   // month[2] = "March";
//   // month[3] = "April";
//   // month[4] = "May";
//   // month[5] = "June";
//   // month[6] = "July";
//   // month[7] = "August";
//   // month[8] = "September";
//   // month[9] = "October";
//   // month[10] = "November";
//   // month[11] = "December";
//   var d = new Date();
//   var n = d.getMonth()+1;
//   document.getElementById(n).click();
// }


var tabs = $('.multiple-tabs');
var selector = $('.multiple-tabs').find('a').length;
//var selector = $(".tabs").find(".selector");
var activeItem = tabs.find('.active');
var activeWidth = activeItem.innerWidth();
$(".tab-selector").css({
  "left": activeItem.position.left + "px",
  "width": activeWidth + "px"
});

$(".multiple-tabs").on("click","a",function(e){
  e.preventDefault();
  $('.multiple-tabs a').removeClass("active");
  $(this).addClass('active');
  var activeWidth = $(this).innerWidth();
  var itemPos = $(this).position();
  $(".tab-selector").css({
    "left":itemPos.left + "px",
    "width": activeWidth + "px"
  });
});

 </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('event.master', ['title'=>'View All Programme'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>