@extends('master', ['title'=>'Welcome to Volunteer Management System'])
@section('container')
@if(Session::get('authority')=='volunteer' || Session::get('authority')=='admin')
<div class="content" >
@if($authority == 'volunteer')
                <div class="left-section">
                                
                                <div class="main-section">
                                        <div class="main-section-content">
                                                <h1 class="sec01"><i class="fa fa-shield" style="margin-right: 10px;color:black;"></i>Rank</h1>
                                                        @if($volunteer_rank == null)
                                                                <h1 style="font-size:80px;">Bronze</h1>
                                                        @else
                                                                <h1 style="font-size:80px;">$volunteer_rank</h1>
                                                        @endif

                                         </div>
                                </div>

                                <div class="main-section">
                                        <div class="main-section-content">
                                                <h1 class="sec02"><i class="fa fa-list-alt" style="margin-right: 10px;color:black;"></i>Events</h1>
                                                <p>Number of Reserved Events : <b>{{$number_of_reserved_events}}</b></p>
                                                <p>Number of Total Completed Events : <b>{{$number_of_attended_events}}</b></p>
                                                <p>Number of Completed Events({{date('Y',mktime(0,0,0,1,1,date("Y")))}}) : <b>{{$annual_completed_events}}</b></p>
                                        </div>
                                </div>

                                <div class="main-section">
                                        <div class="main-section-content">
                                                <h1 class="sec03"><i class="fa fa-clock-o" style="margin-right: 10px;color:black;"></i>Served Hours</h1>
                                                <p>Number of Total Served Hours : <b>{{$lifetime_serve_hours}}</b> hours</p>
                                                <p>Number of Served Hours({{date('Y',mktime(0,0,0,1,1,date("Y")))}}) :  <b>{{$annual_serve_hours}}</b> hours</p>
                                        </div>
                                 </div>
                               
                </div>
                                
        <div class="right-section">
                <div class="ranking-section">
                        <div class="main-section-content">
                                <h1 class="sec01"><i class="fa fa-trophy" style="margin-right: 10px;color:black;"></i>Cybercare Leaderboard</h1>
                                        <table>
                                                <tr>
                                                        <th>No.</th>
                                                        <th>Name</th>
                                                        <th>Occupation</th>
                                                        <th>Served Hour</th>
                                                </tr>
                                                @if(count($lifetime_ranking)>0)
                                                        @foreach($lifetime_ranking as $i => $volunteer)
                                                                <tr>
                                                                        <td>{{$i+1}}</td>
                                                                        <td>{{$volunteer->name}}</td>
                                                                        <td>{{$volunteer->occupation}}</td>
                                                                        <td>{{$volunteer->acc_serve_hour}}</td>
                                                                </tr>
                                                        @endforeach
                                                @else
                                        @endif
                                        </table>
                        </div>
                </div>
                <div class="ranking-section">
                        <div class="main-section-content">
                                <h1 class="sec01"><i class="fa fa-trophy" style="margin-right: 10px;color:black;"></i>Annual Leaderboard({{date('Y')}})</h1>
                                        <table>
                                                <tr>
                                                        <th>No.</th>
                                                        <th>Name</th>
                                                        <th>Occupation</th>
                                                        <th>Served Hour</th>
                                                </tr>
                                                @if(count($annual_ranking)>0)
                                                <?php $i = 1?>
                                                        @foreach($annual_ranking as $volunteer => $serve_hour)
                                                                <tr>
                                                                        <td>{{$i}}</td>
                                                                        <td>{{$volunteer}}</td>
                                                                        <td>{{$name_occupation[$volunteer]}}</td>
                                                                        <td>{{$serve_hour}}</td>
                                                                </tr>
                                                                <?php $i += 1?>
                                                        @endforeach
                                                @else
                                        @endif
                                        </table>
                        </div>
                </div>
        </div>
        @else
        <div class="right-section" style="width:100%;">
                <div class="ranking-section">
                        <div class="main-section-content">
                                <h1 class="sec01"><i class="fa fa-trophy" style="margin-right: 10px;color:black;"></i>Cybercare Leaderboard</h1>
                                        <table class="admin-table">
                                                <tr>
                                                        <th>No.</th>
                                                        <th>Name</th>
                                                        <th>Occupation</th>
                                                        <th>Served Hour</th>
                                                </tr>
                                                @if(count($lifetime_ranking)>0)
                                                        @foreach($lifetime_ranking as $i => $volunteer)
                                                                <tr>
                                                                        <td>{{$i+1}}</td>
                                                                        <td>{{$volunteer->name}}</td>
                                                                        <td>{{$volunteer->occupation}}</td>
                                                                        <td>{{$volunteer->acc_serve_hour}}</td>
                                                                </tr>
                                                        @endforeach
                                                @else
                                        @endif
                                        </table>
                        </div>
                </div>
                <div class="ranking-section">
                        <div class="main-section-content">
                                <h1 class="sec01"><i class="fa fa-trophy" style="margin-right: 10px;color:black;"></i>Annual Leaderboard({{date('Y')}})</h1>
                                        <table  class="admin-table">
                                                <tr>
                                                        <th>No.</th>
                                                        <th>Name</th>
                                                        <th>Occupation</th>
                                                        <th>Served Hour</th>
                                                </tr>
                                                @if(count($annual_ranking)>0)
                                                <?php $i = 1?>
                                                        @foreach($annual_ranking as $volunteer => $serve_hour)
                                                                <tr>
                                                                        <td>{{$i}}</td>
                                                                        <td>{{$volunteer}}</td>
                                                                        <td>{{$name_occupation[$volunteer]}}</td>
                                                                        <td>{{$serve_hour}}</td>
                                                                </tr>
                                                                <?php $i += 1?>
                                                        @endforeach
                                                @else
                                        @endif
                                        </table>
                        </div>
                </div>
        </div>
        @endif
</div>

@else
<script>
 window.location.href = '{{route("auth")}}';
</script>
@endif
@endsection