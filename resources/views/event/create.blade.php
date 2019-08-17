<?php

use App\Common;

?>
@extends('event.master', ['title'=>'Add Event Event'])
@section('content')
   <div class="event-form-container">
        @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


        <div class="panel-body text-right">
            <h1 class='text-center' style="font-size:30px;">Add New Event</h1>

            {!! Form::model($event, [
                'route' => ['event.store'],
                'method' => 'POST',
                'enctype' => 'multipart/form-data',
                'id' => 'add_event',
                'onsubmit' => ' return confirmation()'
                ])!!}

                {{csrf_field()}}
                <div class="form-group row">
                    {!! Form::label('programme-title','Programme Name',['class' => 'control-label col-sm-3']) !!}
					<span class='required'>*</span>
                    <div class="col-sm-7">
                        {!! Form::select('programme-title', Common::GetValidProgrammes(), null,['class' => 'form-control form-control-lg']
                                            )!!}
                    </div>
                </div>
            
                <div class="form-group row">
                    {!! Form::label('name','Event Name',['class' => 'control-label col-sm-3']) !!}
					<span class='required'>*</span>
                    <div class="col-sm-4">
						{!! Form::text('name', null,[
							'id' => 'event-name',
							'class' => 'form-control',
                            'pattern' => '[a-zA-Z0-9\s]+',
                            'required'=>'true',
                            'placeholder' => 'Special characters are not allowed',
                            ])
						!!}
                    </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('date','Event Date',['class' => 'control-label col-sm-3']) !!}
					<span class='required'>*</span>
                    <div class="col-sm-3">
                    {!! Form::date('date', null,[
                                    'id' => 'event-date',
                                    'class' => 'form-control'])!!}
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('start_time','Event Start Time',['class' => 'control-label col-sm-3']) !!}
					<span class='required'>*</span>
                    <div class="col-sm-3">
                    {!! Form::time('start_time', null,[
                                    'id' => 'from-event-time',
                                    'required'=>'true',
                                    'class' => 'form-control'])!!}
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('end_time','Event End Time',['class' => 'control-label col-sm-3']) !!}
					<span class='required'>*</span>
                    <div class="col-sm-3">
                    {!! Form::time('end_time', null,[
                                    'id' => 'to-event-time',
                                    'required'=>'true',
                                    'class' => 'form-control'])!!}
                    </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('venue','Event Venue',['class' => 'control-label col-sm-3']) !!}
					<span class='required'>*</span>
                    <div class="col-sm-4">
                    {!! Form::text('venue', null,[
                                    'id' => 'event-venue',
                                    'required'=>'true',
                                    'class' => 'form-control'])!!}
                    </div>
                </div>

                <div class="form-group row">
                {!! Form::label('description','Event Description',['class' => 'control-label col-sm-3']) !!}
				<span class='required'>*</span>
                <div class="col-sm-4">
                {!! Form::textarea('description', null,[
                                'id' => 'event-description',
                                'required'=>'true',
                                'class' => 'form-control'])!!} 
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('created_by','Created by',['class' => 'control-label col-sm-3']) !!}
					<span class='required'>*</span>
                    <div class="col-sm-3">
                    {!! Form::text('created_by', null,[
                        'id' => 'created_by',
                        'required'=>'true',
                        'class' => 'form-control'])!!}
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('cover_image','Image',['class' => 'control-label col-sm-3']) !!}
					<span class='required'>*</span>
                    <div class="col-sm-3">
                    {{Form::file('cover_image')}}
                    </div>
                </div>

                <div class="form-group row text-center">
                    <div class="col-sm-offset-3 col-sm-6">
                        <input type="submit" class="btn btn-primary" id="submitBtn" >
                        <a href="{{route('event.show-detail',[$event->eid])}}" class="btn btn-danger" onclick="return confirm('Do you want to cancel adding a new event? All the data will not be saved');">Cancel</a>
                    </div>
                </div>

                {!! Form::close() !!}

                
        </div>
   </div>

   <script>
        function confirmation()
    {

        if (!confirm("Make sure that event details are correct, once you proceed after this stage you would not be able to go back." + "\n" + "\n" + "Are you sure you want to Proceed?" + "\n" ))
        {
          return false;
        }
        else
        {
          return true;
        }
    }
   </script>
@endsection