<?php $__env->startSection('content'); ?>
<?php if(count($volunteers)>0): ?>
<table>
        <tr>
            <th>No.</th>
            <th>Name</th>   
            <th>Gender</th>
            <th>Phone Number</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
    
        <?php $__currentLoopData = $volunteers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v => $volunteer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($v+1); ?></td>
            <td><?php echo e($volunteer->name); ?></td>
            
            <td><?php echo e($volunteer->gender); ?></td>
            <td><?php echo e($volunteer->contact_no); ?></td>
            <td><?php echo e($volunteer->email); ?></td>
            <?php if($volunteer->status == 'present'): ?>
                <td><i>Present</i></td>
                <?php elseif($volunteer->status == 'absent'): ?>
                <td><i>Absent</i></td>
            <?php elseif(strtotime(date('Y/m/d')) > strtotime($date)): ?>
                <td>
                <form method="post" id="form<?php echo e($v); ?>" action="<?php echo e(route('volunteer_event.confirm',['id'=>$eid])); ?>" onsubmit="return confirm('Are you sure to mark this volunteer as present?');">
                    <input type="text" value="<?php echo e($volunteer->vid); ?>" name="vid" id="volunteer-id" hidden>
                    <input name="_token" type="hidden" id="_token" value="<?php echo e(csrf_token()); ?>" />
                    <input type="hidden" name="serve_hour" id="<?php echo e($v); ?>" style="width:40px;" min="0" value="0" step=".01" >
                    <input type="hidden" value="Confirm" class="btn btn-primary" id="btn<?php echo e($v); ?>" >
                    </form>
                    <button class="btn btn-primary" onclick="prompt_serve_hour(<?php echo $v; ?>)" id="present<?php echo e($v); ?>">Present</button>
                    </td>
                    <td id="cancel<?php echo e($v); ?>" style="display:none">
                        <button class="btn btn-danger" onclick="hide_serve_hour(<?php echo $v; ?>)" >Cancel</button>
                    </td>
                    <td>
                <form method="post" action="<?php echo e(route('volunteer_event.destroy',['id'=>$eid])); ?>" onsubmit="return confirm('Are you sure to mark this volunteer as absent?');">
                    <input type="text" value="<?php echo e($volunteer->vid); ?>" name="vid" id="volunteer-id" hidden>
                    <input name="_token" type="hidden" id="_token" value="<?php echo e(csrf_token()); ?>" />
                    <input type="submit" value="Absent" class="btn btn-warning" id="absent<?php echo e($v); ?>"></form>
                    </td>
            <?php endif; ?>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    
    <?php if(strtotime(date('Y/m/d')) > strtotime($date)): ?>
    <tr>
        <td colspan="5"><a href=""><i class="fa fa-plus"  style="font-size:15px; color:green;"></i><?php echo link_to_route('volunteer_event.create',
                                $title = 'Add a new volunteer',
                                $parameters = [
                                    'id' => $volunteer->eid]); ?></a></td>
    </tr>
    <?php endif; ?>
    
    <tr><td><a href="<?php echo e(route('event.admin-back-show-detail',['id'=>$eid])); ?>"><button class="btn btn-primary">back</button></a></td></tr>
    </table>
<?php else: ?>
<h1>No volunteer has registered this event yet.</h1>
<td><a href="<?php echo e(route('event.admin-back-show-detail',['id'=>$eid])); ?>"><button class="btn btn-primary">back</button></a></td>
<?php endif; ?>
</div>
<script>
    var msg = '<?php echo e(Session::get('alert')); ?>';
    var exist = '<?php echo e(Session::has('alert')); ?>';
    if(exist){
      alert(msg);
    }
  </script>

  <script>
    function prompt_serve_hour(serve_hour_id){
            document.getElementById("btn"+serve_hour_id).setAttribute('type','submit');
            document.getElementById(serve_hour_id).setAttribute('type','number');
            document.getElementById("present"+serve_hour_id).style.display = 'none';
            document.getElementById("absent"+serve_hour_id).setAttribute('type','hidden');
            document.getElementById("cancel"+serve_hour_id).style.display = 'block';
    }

    function hide_serve_hour(serve_hour_id){
            document.getElementById("btn"+serve_hour_id).setAttribute('type','hidden');
            document.getElementById(serve_hour_id).setAttribute('type','hidden');
            document.getElementById("present"+serve_hour_id).style.display = 'block';
            document.getElementById("absent"+serve_hour_id).setAttribute('type','submit');
            document.getElementById("cancel"+serve_hour_id).style.display = 'none';
    }
  </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('event.master', ['title'=>'Volunteer Details'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>