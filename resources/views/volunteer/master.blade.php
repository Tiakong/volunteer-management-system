

@extends('master', ['title'=>$title])
@section('container')
@if(Session::get('authority')=='volunteer' || Session::get('authority')=='admin')
@yield('content')
@else
<script>
 window.location.href = '{{route("auth")}}';
</script>
@endif
@endsection