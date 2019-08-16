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
            <h1 style="text-align:center; font-size:30px;">Edit Event</h1>

            <?php echo Form::model($event, [
                'route' => ['event.update','id' => $event->eid],
                'enctype' => 'multipart/form-data',
                'id' => 'update_event'
                ]); ?>


                <?php echo e(csrf_field()); ?>

                <div class="form-group row">
                    <?php echo Form::label('programme-title','Programme Title',['class' => 'control-label col-sm-3']); ?>

                    <div class="col-sm-7">
                                            <?php echo Form::text('programme-title', $programme_name,[
                                    'id' => 'programme-title',
                                    'class' => 'form-control',
                                    'style' => 'background:lightgrey;','disabled']); ?>

                    </div>
                </div>
                <?php echo Form::text('pid',$event->pid,[
                            'id' => 'pid',
                            'hidden']); ?>

                <div class="form-group row">
                    <?php echo Form::label('name','Event Name*',['class' => 'control-label col-sm-3']); ?>

                    <div class="col-sm-4">
                    <?php echo Form::text('name', $event->name,[
                                    'id' => 'event-name',
                                    'class' => 'form-control']); ?>

                    </div>
                </div>
                <div class="form-group row">
                    <?php echo Form::label('date','Event Date*',['class' => 'control-label col-sm-3']); ?>

                    <div class="col-sm-2">
                    <?php echo Form::date('date', $event->date,[
                                    'id' => 'event-date',
                                    'class' => 'form-control']); ?>

                    </div>
                </div>

                <div class="form-group row">
                    <?php echo Form::label('start_time','Event Start Time*',['class' => 'control-label col-sm-3']); ?>

                    <div class="col-sm-2">
                    <?php echo Form::time('start_time', $event->start_time,[
                                    'id' => 'from-event-time',
                                    'class' => 'form-control']); ?>

                    </div>
                </div>

                <div class="form-group row">
                    <?php echo Form::label('end_time','Event End Time*',['class' => 'control-label col-sm-3']); ?>

                    <div class="col-sm-2">
                    <?php echo Form::time('end_time', $event->end_time,[
                                    'id' => 'to-event-time',
                                    'class' => 'form-control']); ?>

                    </div>
                </div>
                <div class="form-group row">
                    <?php echo Form::label('venue','Event Venue*',['class' => 'control-label col-sm-3']); ?>

                    <div class="col-sm-4">
                    <?php echo Form::text('venue', $event->venue,[
                                    'id' => 'event-venue',
                                    'class' => 'form-control']); ?>

                    </div>
                </div>

                <div class="form-group row">
                <?php echo Form::label('description','Event Description*',['class' => 'control-label col-sm-3']); ?>

                <div class="col-sm-4">
                <?php echo Form::textarea('description', $event->description,[
                                'id' => 'event-description',
                                'class' => 'form-control']); ?> 
                    </div>
                </div>

                <div class="form-group row">
                    <?php echo Form::label('created_by','Edited by*',['class' => 'control-label col-sm-3']); ?>

                    <div class="col-sm-3">
                    <?php echo Form::text('created_by', $event->created_by,[
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


                <div class="form-group row" style="margin-top:30px">
                        <input type="submit" class="btn btn-primary" style="display:block; margin-left:auto; margin-right:10px" id="submitBtn">
                    <a href="<?php echo e(route('event.admin-back-show-detail',[$event->eid])); ?>" style="display:block; margin-right:auto;"><button class="btn btn-danger" >Cancel</button></a>
                    </div>
                </div>
        </div>  
        
    </div>
</div>

<script>
        $(document).ready(function(){
    $("#submitBtn").click(function(){    
        var response =  confirm('Do you want to update this event?');   

        if(response){
            $("#update_event").submit(); // Submit the form
        }
        
    });
});
    
   </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('event.master', ['title'=>'Event Management'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>