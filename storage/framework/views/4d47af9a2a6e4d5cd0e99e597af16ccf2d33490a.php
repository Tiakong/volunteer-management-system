<?php
use App\Common;
 ?>

 
 <?php $__env->startSection('content'); ?>

<div class="container" >


    <?php if($errors->any()): ?>
            <div class="alert alert-danger">
              <ul> 
              <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul>
            </div>
    <?php endif; ?>  

    <div class="alert alert-danger" id="alert-div" style="display:none;">

    <ul id="alert-box"> 
                      
    </ul>
    </div>

          <div class="panel-body">
          <h1 style="text-align:center; font-size:30px;">Edit Programme</h1>
          <?php echo Form::model($programme, [
            'route' => ['programme.update',$programme->pid],
            'method' =>'put',
            'class' => 'form horizontal',
            'enctype' => 'multipart/form-data',
            ]); ?>


            <div class="form-group row">
                <?php echo Form::label('programme-name','Programme Name',[
                'class' => 'control-label col-sm-3',
                ]); ?>


                <div class="col-sm-7">
                <?php echo Form::text('name',$programme->name,[
                  'id' => 'programme-name',
                  'class' =>'form-control',
                  'required'=>'true',]); ?>

                </div>

            </div>

            <div class="form-group row">
              <?php echo Form::label('programme-code','Programme Code',[
              'class' => 'control-label col-sm-3',]); ?>

              <div class="col-sm-7">
                <?php echo Form::text('code',$programme->code,[
                'id' => 'programme-code',
                'class' =>'form-control',
                'required'=>'true',]); ?>

              </div>

            </div>

            <div class="form-group row">
              <?php echo Form::label('programme-start_month','Programme Start',[
              'class' => 'control-label col-sm-3',]); ?>


                <div class="col-sm-4">
                <?php echo Form::select('start_month', Common::$Month,$programme->start_month,[
                'placeholder' => 'Select Month',
                'id' => 'start-month',
                'required'=>'true',]); ?>


                <?php echo Form::selectRange('start_year',date('Y'),date('Y')+1,$programme->start_year,[
                'placeholder' => 'Select Year',
                'id' => 'start-year',
                'required'=>'true',]); ?>

                </div>

            </div>

            <div class="form-group row">
              <?php echo Form::label('programme-end','Programme End',[
              'class' => 'control-label col-sm-3',]); ?>

              
              <div class="col-sm-4">
                <?php echo Form::select('end_month',Common::$Month,$programme->end_month,[
                'placeholder' => 'Select Month',
                'id' => 'end-month',
                'required'=>'true',]); ?>


                <?php echo Form::selectRange('end_year',date('Y'),date('Y')+1,$programme->end_year,[
                'placeholder' => 'Select Year',
                'id' => 'end-year',
                'required'=>'true',]); ?>

              </div>

            </div>

            <div class="form-group row">
              <?php echo Form::label('programme-target','Target',[
              'class' => 'control-label col-sm-3',]); ?>


              <div class="col-sm-7">
                <?php echo Form::text('target',$programme->target,[
                'id' => 'programme-target',
                'class' =>'form-control',
                'required'=>'true',]); ?>

              </div>

            </div>

            <div class="form-group row">
              <?php echo Form::label('programme-contact','Contact',[
              'class' => 'control-label col-sm-3',
              ]); ?>

              <div class="col-sm-3">
                <?php echo Form::text('contact',$programme->contact,[
                'id' => 'programme-contact',
                'class' =>'form-control',
                'required'=>'true',]); ?>

              </div>
            </div>

            <div class="form-group row">
              <?php echo Form::label('programme-venue','Programme Venue',[
              'class' => 'control-label col-sm-3',
              ]); ?>

              <div class="col-sm-4">
                <?php echo Form::text('venue',$programme->venue,[
                'id' => 'programme-venue',
                'class' =>'form-control',
                'required'=>'true',]); ?>

              </div>

            </div>


            <div class="form-group row">
              <?php echo Form::label('programme-description','Programme Description',[
              'class' => 'control-label col-sm-3',
              ]); ?>

              <div class="col-sm-7">
                <?php echo Form::textarea('description',$programme->description,[
                'id' => 'programme-description',
                'class' =>'form-control',
                'required'=>'true',]); ?>

              </div>

            </div>

            <div class="form-group row" >
            <?php echo Form::label('partner','Supporting Partner',[
              'class' => 'control-label col-sm-3',
              ]); ?>


              <?php $__currentLoopData = $programmeImage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php if(Storage::disk('public')->exists('cover_image/'.$image->filename)): ?>
                    <img src ="/storage/cover_image/<?php echo e($image->filename); ?>" width="165px" height="165px" style="padding:10px;">
                  <?php endif; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <table class="control-label col-sm-3">
              <tr>
                <td>No.</td>
                <td>File name</td>
                <td>Delete</td>
                </tr>
              <?php 
               $count = 1;
              foreach($programmeImage as $image)
              {
                  echo "<tr>";
                  echo "<td> $count </td>";
                  echo "<td> {$image->filename} </td>";
                  echo "<td><input type='checkbox' name='delete_filename[]' value={$image->filename}></td>";
                  echo "</tr>";              
                  $count +=1;
              }
              ?>  
              </table>
            </div>

              <div class="form-group row">
              <?php echo Form::label('programme-partner','New Image',[
              'class' => 'control-label col-sm-3',
              ]); ?>

              <input type="file" name="cover_image[]" multiple accept="image/x-png,image/gif,image/jpeg">
              </div>

            <div class="form-group_row">
              <div class="col-sm-offset-3 col-sm-6">
              <?php echo Form::button('Update',[
              'type' => 'submit',
              'class' => 'btn btn-primary',
              'onclick' => 'return validate()'
              ]); ?>


            </div>
            </div>
            <?php echo Form::close(); ?>



            </div>




        </div>

        <script>
    
        function validate()
        {
          $('#alert-box').empty();
          var start_month = parseInt(document.getElementById("start-month").value);
          var end_month = parseInt(document.getElementById("end-month").value);
          var start_year = parseInt(document.getElementById("start-year").value);
          var end_year = parseInt(document.getElementById("end-year").value);
          var validate = true;

          if (start_year && end_year != "")
          {
            if (start_year > end_year)
            {
                  var ul = document.getElementById("alert-box");
                  var li = document.createElement("li");
                  var text = document.createTextNode("End Year Should Be More Than Start Year");
                  li.appendChild(text);
                  ul.appendChild(li);
                  validate = false;
                  document.getElementById("alert-div").style.display ="block";
            }
            else
            {
              if(start_month && end_month != "")
              {
                if(end_month < start_month)
                {
                  var ul = document.getElementById("alert-box");
                  var li = document.createElement("li");
                  var text = document.createTextNode("End Month Should Be More Than Start Month");
                  li.appendChild(text);
                  ul.appendChild(li);
                  validate = false;
                  document.getElementById("alert-div").style.display ="block";
                }
              }
            }
            if(validate==true)
            {
              document.getElementById("alert-div").style.display = "none";
            }
          }
          return validate;
        }

       

        </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('programme.master', ['title'=>'Edit Programme'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>