<div class="bg-modal">
    <div class="closelogo"><p>+</p></div>
    <div class="pop-up-container">
        <ul class="pop-up-ul" id="pop-up-navigation-bar">
                <li><a href="<?php echo e(route('home')); ?>" ><i class="fa fa-home" style="margin-right: 10px"></i>Home</a></li>
            <li><a href="<?php echo e(route('event.index')); ?>" ><i class="fa fa-ticket" style="margin-right: 10px"></i>Event Reservation</a>
            </li>
            <li><a href="<?php echo e(route('volunteer.show')); ?>"><i class="fa fa-user" style="margin-right: 10px"></i>My Profile</a>
            </li>
            <li><a href="<?php echo e(route('notification.index')); ?>"><i class="fa fa-bell" style="margin-right: 10px"></i>Notification</a>
            </li>
            <li><a href="<?php echo e(url('/award')); ?>"><i class="fa fa-trophy" style="margin-right: 10px"></i>Award</a>
            </li>
            <li><a href="<?php echo e(route('logout')); ?>" onclick="return confirm('Do you want to log out now?');"><i class="fa fa-sign-out" style="margin-right: 10px"></i>Log Out</a>
            </li>
        </ul>
    </div>
</div>	