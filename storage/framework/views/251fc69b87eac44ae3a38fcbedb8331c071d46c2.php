<?php

use App\Common;

?>

<?php $__env->startSection('content'); ?>
   <div class="event-form-container">
        <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>  


        <div class="panel-body">
            <h1 style="text-align:center; font-size:30px;">Add New Event</h1>

            <?php echo Form::model($event, [
                'route' => ['event.store'],
                'method' => 'POST',
                'enctype' => 'multipart/form-data',
                'id' => 'add_event'
                ]); ?>


                <?php echo e(csrf_field()); ?>

                <div class="form-group row">
                    <?php echo Form::label('programme-title','Programme Title*',['class' => 'control-label col-sm-3']); ?>

                    <div class="col-sm-7">
                        <?php echo Form::select('programme-title', Common::GetValidProgrammes(), null,['class' => 'form-control form-control-lg']
                                            ); ?>

                    </div>
                </div>
            
                <div class="form-group row">
                    <?php echo Form::label('name','Event Name*',['class' => 'control-label col-sm-3']); ?>

                    <div class="col-sm-4">
                    <?php echo Form::text('name', null,[
                                    'id' => 'event-name',
                                    'class' => 'form-control']); ?>

                    </div>
                </div>
                <div class="form-group row">
                    <?php echo Form::label('date','Event Date*',['class' => 'control-label col-sm-3']); ?>

                    <div class="col-sm-3">
                    <?php echo Form::date('date', null,[
                                    'id' => 'event-date',
                                    'class' => 'form-control']); ?>

                    </div>
                </div>

                <div class="form-group row">
                    <?php echo Form::label('start_time','Event Start Time*',['class' => 'control-label col-sm-3']); ?>

                    <div class="col-sm-3">
                    <?php echo Form::time('start_time', null,[
                                    'id' => 'from-event-time',
                                    'class' => 'form-control']); ?>

                    </div>
                </div>

                <div class="form-group row">
                    <?php echo Form::label('end_time','Event End Time*',['class' => 'control-label col-sm-3']); ?>

                    <div class="col-sm-3">
                    <?php echo Form::time('end_time', null,[
                                    'id' => 'to-event-time',
                                    'class' => 'form-control']); ?>

                    </div>
                </div>
                <div class="form-group row">
                    <?php echo Form::label('venue','Event Venue*',['class' => 'control-label col-sm-3']); ?>

                    <div class="col-sm-4">
                    <?php echo Form::text('venue', null,[
                                    'id' => 'event-venue',
                                    'class' => 'form-control']); ?>

                    </div>
                </div>

                <div class="form-group row">
                <?php echo Form::label('description','Event Description*',['class' => 'control-label col-sm-3']); ?>

                <div class="col-sm-4">
                <?php echo Form::textarea('description', null,[
                                'id' => 'event-description',
                                'class' => 'form-control']); ?> 
                    </div>
                </div>

                <div class="form-group row">
                    <?php echo Form::label('created_by','Created by*',['class' => 'control-label col-sm-3']); ?>

                    <div class="col-sm-3">
                    <?php echo Form::text('created_by', null,[
                        'id' => 'created_by',
                        'class' => 'form-control']); ?>

                    </div>
                </div>

                <div class="form-group row">
                    <?php echo Form::label('cover_image','Image',['class' => 'control-label col-sm-3']); ?>

                    <div class="col-sm-3">
                    <?php echo e(Form::file('cover_image')); ?>

                    </div>
                </div>

                <?php echo Form::close(); ?>


                <div class="form-group row">
                    <div class="col-sm-offset-3 col-sm-6">
                        <input type="submit" class="btn btn-primary" style="margin-top:30px;" id="submitBtn" >
                    </div>
                </div>
            
        </div>
   </div>

   <script>
        $(document).ready(function(){
    $("#submitBtn").click(function(){    
        var response =  confirm('Do you want to create this event?');   

        if(response){
            $("#add_event").submit(); // Submit the form
        }
        
    });
});
    
   </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('event.master', ['title'=>'Add Event Event'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>