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


        <div class="panel-body">
            <h1 style="text-align:center; font-size:30px;">Add New Event</h1>

            {!! Form::model($event, [
                'route' => ['event.store'],
                'method' => 'POST',
                'enctype' => 'multipart/form-data',
                'id' => 'add_event'
                ])!!}

                {{csrf_field()}}
                <div class="form-group row">
                    {!! Form::label('programme-title','Programme Title*',['class' => 'control-label col-sm-3']) !!}
                    <div class="col-sm-7">
                        {!! Form::select('programme-title', Common::GetValidProgrammes(), null,['class' => 'form-control form-control-lg']
                                            )!!}
                    </div>
                </div>
            
                <div class="form-group row">
                    {!! Form::label('name','Event Name*',['class' => 'control-label col-sm-3']) !!}
                    <div class="col-sm-4">
                    {!! Form::text('name', null,[
                                    'id' => 'event-name',
                                    'class' => 'form-control'])!!}
                    </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('date','Event Date*',['class' => 'control-label col-sm-3']) !!}
                    <div class="col-sm-3">
                    {!! Form::date('date', null,[
                                    'id' => 'event-date',
                                    'class' => 'form-control'])!!}
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('start_time','Event Start Time*',['class' => 'control-label col-sm-3']) !!}
                    <div class="col-sm-3">
                    {!! Form::time('start_time', null,[
                                    'id' => 'from-event-time',
                                    'class' => 'form-control'])!!}
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('end_time','Event End Time*',['class' => 'control-label col-sm-3']) !!}
                    <div class="col-sm-3">
                    {!! Form::time('end_time', null,[
                                    'id' => 'to-event-time',
                                    'class' => 'form-control'])!!}
                    </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('venue','Event Venue*',['class' => 'control-label col-sm-3']) !!}
                    <div class="col-sm-4">
                    {!! Form::text('venue', null,[
                                    'id' => 'event-venue',
                                    'class' => 'form-control'])!!}
                    </div>
                </div>

                <div class="form-group row">
                {!! Form::label('description','Event Description*',['class' => 'control-label col-sm-3']) !!}
                <div class="col-sm-4">
                {!! Form::textarea('description', null,[
                                'id' => 'event-description',
                                'class' => 'form-control'])!!} 
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('created_by','Created by*',['class' => 'control-label col-sm-3']) !!}
                    <div class="col-sm-3">
                    {!! Form::text('created_by', null,[
                        'id' => 'created_by',
                        'class' => 'form-control'])!!}
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('cover_image','Image',['class' => 'control-label col-sm-3']) !!}
                    <div class="col-sm-3">
                    {{Form::file('cover_image')}}
                    </div>
                </div>

                {!! Form::close() !!}

                <div class="form-group row">
                    <div class="col-sm-offset-3 col-sm-6">
                        <input type="submit" class="btn btn-primary" style="margin-top:30px;" id="submitBtn" >
                    </div>
                </div>
            
        </div>
   </div>

   <script>
        $(document).ready(function(){
    $("#submitBtn").click(function(){    
        var response =  confirm('Do you want to create this event?');   

        if(response){
            $("#add_event").submit(); // Submit the form
        }
        
    });
});
    
   </script>
@endsection