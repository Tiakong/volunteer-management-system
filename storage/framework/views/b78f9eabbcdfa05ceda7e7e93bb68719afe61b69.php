<?php

use App\Common;
?>


<?php $__env->startSection('container'); ?>


<style>
body {
  font-family: Arial;
  margin: 0;
}

* {
  box-sizing: border-box;
}

img {
  vertical-align: middle;
}

/* Position the image container (needed to position the left and right arrows) */
.container {
  position: relative;
}

/* Hide the images by default */
.mySlides {
  display: none;
}

/* Add a pointer when hovering over the thumbnail images */
.cursor {
  cursor: pointer;
}

/* Next & previous buttons */
.prev,
.next {
  cursor: pointer;
  position: absolute;
  top: 40%;
  width: auto;
  padding: 16px;
  margin-top: -50px;
  color: white;
  font-weight: bold;
  font-size: 20px;
  border-radius: 0 3px 3px 0;
  user-select: none;
  -webkit-user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover,
.next:hover {
  background-color: rgba(0, 0, 0, 0.8);
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* Container for image text */
.caption-container {
  text-align: center;
  background-color: #222;
  padding: 2px 16px;
  color: white;
}

.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Six columns side by side */
.column {
  float: left;
  width: 16.66%;
}

/* Add a transparency effect for thumnbail images */
.demo {
  opacity: 0.6;
}

.active,
.demo:hover {
  opacity: 1;
}
</style>
<body>

<h2 style="text-align:center">Volunteer Rank</h2>
<?php if($volunteer_rank!=null): ?>
<h3 style="text-align:center">Your serve hours: <?php echo e($volunteer_serve_hour); ?> -> <?php echo e($volunteer_rank); ?></h3>
<?php else: ?>
<h3 style="text-align:center">Your serve hours: <?php echo e($volunteer_serve_hour); ?> -> Bronze</h3>
<?php endif; ?>

<div class="container">
  <div class="mySlides">
    <div class="numbertext">1 / 6</div>
    <img src="<?php echo e(asset('award_pics/bronze.png')); ?>" style="width:100%;height:500px;">
  </div>

  <div class="mySlides">
    <div class="numbertext">2 / 6</div>
    <img src="<?php echo e(asset('award_pics/silver.png')); ?>" style="width:100%;height:500px;">
  </div>

  <div class="mySlides">
    <div class="numbertext">3 / 6</div>
    <img src="<?php echo e(asset('award_pics/gold.png')); ?>" style="width:100%;height:500px;">
  </div>
    
  <div class="mySlides">
    <div class="numbertext">4 / 6</div>
    <img src="<?php echo e(asset('award_pics/platinum.png')); ?>" style="width:100%;height:500px;">
  </div>

  <div class="mySlides">
    <div class="numbertext">5 / 6</div>
    <img src="<?php echo e(asset('award_pics/diamond.png')); ?>" style="width:100%;height:500px;">
  </div>
    
  <div class="mySlides">
    <div class="numbertext">6 / 6</div>
    <img src="<?php echo e(asset('award_pics/glory.png')); ?>" style="width:100%;height:500px;">
  </div>
    
  <a class="prev" onclick="plusSlides(-1)">❮</a>
  <a class="next" onclick="plusSlides(1)">❯</a>

  <div class="caption-container">
    <p id="caption"></p>
  </div>

  <div class="row">
    <div class="column">
      <img class="demo cursor" src="<?php echo e(asset('award_pics/bronze.png')); ?>" style="width:100%" onclick="currentSlide(1)" alt="Bronze Rank">
    </div>
    <div class="column">
      <img class="demo cursor" src="<?php echo e(asset('award_pics/silver.png')); ?>" style="width:100%" onclick="currentSlide(2)" alt="Silver Rank">
    </div>
    <div class="column">
      <img class="demo cursor" src="<?php echo e(asset('award_pics/gold.png')); ?>" style="width:100%" onclick="currentSlide(3)" alt="Gold Rank">
    </div>
    <div class="column">
      <img class="demo cursor" src="<?php echo e(asset('award_pics/platinum.png')); ?>" style="width:100%" onclick="currentSlide(4)" alt="Platinum Rank">
    </div>
    <div class="column">
      <img class="demo cursor" src="<?php echo e(asset('award_pics/diamond.png')); ?>" style="width:100%" onclick="currentSlide(5)" alt="Diamond Rank">
    </div>    
    <div class="column">
      <img class="demo cursor" src="<?php echo e(asset('award_pics/glory.png')); ?>" style="width:100%" onclick="currentSlide(6)" alt="Glory Rank">
    </div>
  </div>
</div>

<script>
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', ['title'=>'Award Rank'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>