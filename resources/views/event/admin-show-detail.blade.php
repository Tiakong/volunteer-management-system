@extends('event.master', ['title'=>'Event Management'])
@section('content')

    <div class="event-detail-board" style="margin:30px 0px;">
            <div class="event-detail-left-section">
                <div class="event-detail-topleft-section">
                    <p>{{$event->name}}</p><p id="creator">By: {{$event->created_by}}</p>
                    
                </div>
                <div class="event-detail-btmleft-section">
                    <div class="event-detail-date">
                        <i class="material-icons event-detail-icon">date_range</i>
                        <p class="event-info-font">{{$event->date}}</p>
                    </div>
                    <div  class="event-detail-time">
                        <i class="material-icons event-detail-icon">alarm</i>
                        <p class="event-info-font">{{date('h:i a',strtotime($event->start_time))}} - {{date('h:i a',strtotime($event->end_time))}}</p>
                    </div>
                    <div  class="event-detail-venue">
                        <i class="material-icons event-detail-icon">location_city</i>
                        <p class="event-info-font">{{$event->venue}}</p>
                    </div>
                    <div  class="event-detail-venue">
                    @if(strtotime(date('Y/m/d')) < strtotime($event->date))
                    <button class="event-detail-button btn btn-warning">{!! link_to_route('event.edit',
                                $title = 'Edit Event',
                                $parameters = [
                                    'id' => $event->eid])!!}</button>
                    <button class="event-detail-button btn btn-danger" onclick="return confirm('Do you want to delete this event?');">{!! link_to_route('event.destroy',
                                $title = 'Remove Event',
                                $parameters = [
                                    'id' => $event->eid])!!}</button>
                    @endif
                    <button class="event-detail-button btn btn-primary" >{!! link_to_route('volunteer_event.index',
                                $title = 'Volunteer List',
                                $parameters = [
                                    'id' => $event->eid])!!}</button>
                    </div>
                </div>
            </div>

            <div class="event-detail-right-section">
                <div class="event-detail-topright-section">
                    <img src="/storage/cover_image/{{$event->cover_image}}" width="100%" height="100%">
                </div>
                <div class="event-detail-description">
                    <p>{{$event->description}}
                </div>
            </div>
    </div>

    <button class="event-detail-button btn btn-primary">{!! link_to_route('event.index',
                                $title = 'Back')!!}</button>

    

    <script>
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
      alert(msg);
    }
  </script>
@endsection