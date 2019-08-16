<div class="bg-modal">
    <div class="closelogo"><p>+</p></div>
    <div class="pop-up-container">
        <ul class="pop-up-ul" id="pop-up-navigation-bar">
                <li><a href="{{ route('home') }}" ><i class="fa fa-home" style="margin-right: 10px"></i>Home</a></li>
            <li><a href="#"><i class="fa fa-calendar-plus-o" style="margin-right: 10px"></i>Programme Management</a>
                <ul>
                    <li><a href="{{route('programme.index')}}" ><i class="fa fa-eye" style="margin-right: 10px"></i>View Programme</a></li>
                    <li><a href="{{route('programme.create')}}" ><i class="fa fa-plus-square" style="margin-right: 10px"></i>Add Programme</a></li>
                </ul>
            </li>
            <li><a href="#"><i class="fa fa-list-alt" style="margin-right: 10px"></i>Event Management</a>
                <ul>
                    <li><a href="{{ route('event.index') }}" ><i class="fa fa-eye" style="margin-right: 10px"></i>View Event</a></li>
                    <li><a href="{{ url('event/create') }}" ><i class="fa fa-plus-square" style="margin-right: 10px"></i>Add Event</a></li>
                </ul>
            </li>
            <li><a href="#" ><i class="fa fa-bell" style="margin-right: 10px"></i>Notification</a>
                <ul>
                    <li><a href="{{route('notification.index')}}" ><i class="fa fa-eye" style="margin-right: 10px"></i>View Notification</a></li>
                    <li><a href="{{route('notification.create')}}" ><i class="fa fa-plus-square" style="margin-right: 10px"></i>Add Notification</a></li>
                </ul>
            </li>
            <li><a href="#" ><i class="fa fa-briefcase" style="margin-right: 10px"></i>Administrative Work</a>
                <ul>
                    <li><a href="{{route('officework.index')}}" ><i class="fa fa-search" style="margin-right: 10px"></i>Record Voluntary Administrative Work</a></li>
                    <li><a href="{{url('admin/search-volunteer')}}" ><i class="fa fa-plus-square" style="margin-right: 10px"></i>Search Volunteer</a></li>
                    <li><a href="{{route('admin.export-data')}}" ><i class="fa fa-database" style="margin-right: 10px"></i>Export Data</a></li>
                </ul>
            </li>

            <li>
            <a href="{{route('logout')}}" onclick="return confirm('Do you want to log out now?');"><i class="fa fa-sign-out" style="margin-right: 10px"></i>Log Out</a>
            </li>
        </ul>
    </div>
</div>	