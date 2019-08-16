
@extends('master', ['title'=>'Login'])

@section('container')
<div class='col-sm-9'>
	<br>
	@include('common.show-error')
	</br>
	<form name='submitForm' method='post' class='text-right' action='{{url("login-validate")}}'>
		{{ csrf_field() }}
		<div id='username'>
			<div class='p-3 row'>
				{!! Form::label('email', 'Email:', [
					'class' => 'control-label col-sm-3 p-2',
				]) !!}
				<div class="col-sm-9">
					<input name='username' type='text' class='form-control' placeholder='email' />
				</div>
			</div>
		</div>
		<div id='password'>
			<div class='p-3 row'>
				{!! Form::label('password', 'Password:', [
					'class' => 'control-label col-sm-3 p-2',
				]) !!}
				<div class="col-sm-9">
					<input name='password' type='password' onkeydown='Submit(event)' class='form-control' placeholder='password' />
				</div>
			</div>
		</div>
	</form>
	<div class='text-center p-2'>
		<button id='submitBtn' style='margin:8px;width:25%;' class='p-3 btn btn-primary' onclick='SubmitForm()'>Login</button>
		<p style='margin:8px;' >Don't have an <a href='{{route("register")}}'>account</a>?</p>
	</div>
</div>

<script>
function Submit(e)
{
	console.log(e);
	//If enter key was pressed
	if(e.keyCode == 13)
		document.getElementById('submitBtn').click();
}
</script>

<script>
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
      alert(msg);
    }
  </script>
@endsection
