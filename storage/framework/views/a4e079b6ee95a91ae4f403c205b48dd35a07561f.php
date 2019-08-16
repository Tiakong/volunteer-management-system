<?php
use App\Event;
?>


<?php $__env->startSection('content'); ?>
    <div class="event-container">
        <?php echo $__env->make('event.programme_slidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <div class="event-list">
            <div class="event-horizontal-container">
                <div class="event-selection-box">
                    <table>
                        <tr>
                            <td>Event Name:</td>
                            <td>#1</td>
                        </tr>
                        <tr>
                            <td>Event Date & Time:</td>
                            <td>#1</td>
                        </tr>
                        <tr>
                            <td>Event Venue:</td>
                            <td>#1</td>
                        </tr>
                        <tr>
                            <td>Event Detail</td>
                        </tr>
                        <tr>
                            <td><a href="/eventDetail">See More...</a><td>
                        </tr>
                    </table>
                </div>
                <div class="event-selection-box"></div>
                <div class="event-selection-box"></div>
            </div>

            <div class="event-horizontal-container">
                <div class="event-selection-box"></div>
                <div class="event-selection-box"></div>
                <div class="event-selection-box"></div>
            </div>

            <div class="event-horizontal-container">
                <div class="event-selection-box"></div>
                <div class="event-selection-box"></div>
                <div class="event-selection-box"></div>
            </div>
        </div>

        
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('event.master', ['title'=>'Index of Events'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>