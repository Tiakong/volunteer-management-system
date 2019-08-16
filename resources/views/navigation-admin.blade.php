<div class="bottom-header-container">
	<a href="{{route('home')}}">
        <img src="{{asset('pics/cybercare.png')}}" class="imgsize">
    </a>
    <div class="dy-navbar" id="navigation-bar">
        
        <div class="dy-dropdown">
                <button class="dy-dropbtn">
                    <a href="{{ route('home') }}"><i class="fa fa-home" style="margin-right: 10px"></i>Home</a>
                </button>
        </div>

        <div class="dy-dropdown">
            <button class="dy-dropbtn">
            <i class="fa fa-calendar-plus-o" style="margin-right: 10px"></i>Programme Management
            </button>

            <div class="dy-dropdown-content">
                <a href="{{route('programme.index')}}"><i class="fa fa-eye" style="margin-right: 10px"></i>View programme</a>
                <a href="{{route('programme.create')}}"><i class="fa fa-plus-square" style="margin-right: 10px"></i>Add programme</a>
            </div>
        </div>

        <div class="dy-dropdown">
            <button class="dy-dropbtn">
            <i class="fa fa-list-alt" style="margin-right: 10px"></i>Event Management
            </button>
            <div class="dy-dropdown-content">
                <a href="{{ route('event.index') }}"><i class="fa fa-eye" style="margin-right: 10px"></i>View event</a>
                <a href="{{ url('event/create') }}"><i class="fa fa-plus-square" style="margin-right: 10px"></i>Add event</a>
            </div>
        </div>

        <div class="dy-dropdown">
            <button class="dy-dropbtn"><i class="fa fa-bell" style="margin-right: 10px"></i>
                Notification
            </button>
            <div class="dy-dropdown-content">
                <a href="{{route('notification.index')}}"><i class="fa fa-eye" style="margin-right: 10px"></i>View notification</a>
                <a href="{{route('notification.create')}}"><i class="fa fa-plus-square" style="margin-right: 10px"></i>Create notification</a>
            </div>
        </div>   

        <div class="dy-dropdown">
            <button class="dy-dropbtn"><i class="fa fa-briefcase" style="margin-right: 10px"></i>
                Administrative Work
            </button>
            <div class="dy-dropdown-content">
                <a href="{{route('officework.index')}}"><i class="fa fa-search" style="margin-right: 10px"></i>Assign office work</a>
                <a href="{{url('admin/search-volunteer')}}"><i class="fa fa-plus-square" style="margin-right: 10px"></i>Search volunteer</a>
                <a href="{{route('admin.export-data')}}"><i class="fa fa-database" style="margin-right: 10px"></i>Export data</a>
            </div>
        </div>

        <div class="dy-dropdown">
                    <button class="dy-dropbtn">
                    
                        <a href="{{route('logout')}}" onclick="return confirm('Do you want to log out now?');"><i class="fa fa-sign-out" style="margin-right: 10px"></i>Log Out</a>
                    </button>
            </div>
			
		<i class="fa fa-bars side-bar-button" id="side-bar-button" style="font-size:30px; color:rgb(248, 248, 248); cursor: pointer;"></i>
    </div>
</div>
