<div class="bottom-header-container">
	<a href="{{route('home')}}">
            <img src="{{asset('pics/cybercare.png')}}" class="imgsize">
        </a>
        <div class="dy-navbar" id="navigation-bar">
            
            <div class="dy-dropdown">
                    <button class="dy-dropbtn">
                   
                        <a href="{{ route('home') }}"> <i class="fa fa-home" style="margin-right: 10px"></i>Home</a>
                    </button>
            </div>

            <div class="dy-dropdown">
                    <button class="dy-dropbtn">
                    
                        <a href="{{route('event.index')}}"><i class="fa fa-ticket" style="margin-right: 10px"></i>Event Reservation</a>
                    </button>
            </div>

            <div class="dy-dropdown">
                    <button class="dy-dropbtn">
                    
                        <a href="{{route('volunteer.show')}}"><i class="fa fa-user" style="margin-right: 10px"></i>My Profile</a>
                    </button>
            </div>

            <div class="dy-dropdown">
                    <button class="dy-dropbtn">
                    
                        <a href="{{route('notification.index')}}"><i class="fa fa-bell" style="margin-right: 10px"></i>Notification</a>
                    </button>
            </div>

            <div class="dy-dropdown">
                    <button class="dy-dropbtn">
                    
                        <a href="{{url('award')}}"><i class="fa fa-trophy" style="margin-right: 10px"></i>Award</a>
                    </button>
            </div>

            <div class="dy-dropdown">
                    <button class="dy-dropbtn">
                    
                        <a href="{{route('logout')}}"><i class="fa fa-sign-out" style="margin-right: 10px"></i>Log Out</a>
                    </button>
            </div>
         <i class="fa fa-bars side-bar-button" id="side-bar-button" style="font-size:30px; color:rgb(248, 248, 248); cursor: pointer;"></i>
    </div>
</div>
