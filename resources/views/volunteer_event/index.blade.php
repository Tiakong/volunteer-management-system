@extends('event.master', ['title'=>'Volunteer Details'])
@section('content')
@if(count($volunteers)>0)
<table>
        <tr>
            <th>No.</th>
            <th>Name</th>   
            <th>Gender</th>
            <th>Phone Number</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
    
        @foreach($volunteers as $v => $volunteer)
        <tr>
            <td>{{$v+1}}</td>
            <td>{{$volunteer->name}}</td>
            
            <td>{{$volunteer->gender}}</td>
            <td>{{$volunteer->contact_no}}</td>
            <td>{{$volunteer->email}}</td>
            @if($volunteer->status == 'present')
                <td><i>Present</i></td>
                @elseif($volunteer->status == 'absent')
                <td><i>Absent</i></td>
            @elseif(strtotime(date('Y/m/d')) > strtotime($date))
                <td>
                <form method="post" id="form{{$v}}" action="{{ route('volunteer_event.confirm',['id'=>$eid]) }}" onsubmit="return confirm('Are you sure to mark this volunteer as present?');">
                    <input type="text" value="{{$volunteer->vid}}" name="vid" id="volunteer-id" hidden>
                    <input name="_token" type="hidden" id="_token" value="{{ csrf_token() }}" />
                    <input type="hidden" name="serve_hour" id="{{$v}}" style="width:40px;" min="0" value="0" step=".01" >
                    <input type="hidden" value="Confirm" class="btn btn-primary" id="btn{{$v}}" >
                    </form>
                    <button class="btn btn-primary" onclick="prompt_serve_hour(<?php echo $v; ?>)" id="present{{$v}}">Present</button>
                    </td>
                    <td id="cancel{{$v}}" style="display:none">
                        <button class="btn btn-danger" onclick="hide_serve_hour(<?php echo $v; ?>)" >Cancel</button>
                    </td>
                    <td>
                <form method="post" action="{{ route('volunteer_event.destroy',['id'=>$eid]) }}" onsubmit="return confirm('Are you sure to mark this volunteer as absent?');">
                    <input type="text" value="{{$volunteer->vid}}" name="vid" id="volunteer-id" hidden>
                    <input name="_token" type="hidden" id="_token" value="{{ csrf_token() }}" />
                    <input type="submit" value="Absent" class="btn btn-warning" id="absent{{$v}}"></form>
                    </td>
            @endif
        </tr>
        @endforeach
    
    @if(strtotime(date('Y/m/d')) > strtotime($date))
    <tr>
        <td colspan="5"><a href=""><i class="fa fa-plus"  style="font-size:15px; color:green;"></i>{!! link_to_route('volunteer_event.create',
                                $title = 'Add a new volunteer',
                                $parameters = [
                                    'id' => $volunteer->eid])!!}</a></td>
    </tr>
    @endif
    
    <tr><td><a href="{{route('event.admin-back-show-detail',['id'=>$eid])}}"><button class="btn btn-primary">back</button></a></td></tr>
    </table>
@else
<h1>No volunteer has registered this event yet.</h1>
<td><a href="{{route('event.admin-back-show-detail',['id'=>$eid])}}"><button class="btn btn-primary">back</button></a></td>
@endif
</div>
<script>
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
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

@endsection
