
@if(count($errors) > 0)
<div class="text-left alert alert-danger alert-dismissible fade show">
	<strong>Errors occured!</strong>
	<ul>
		@foreach($errors->all() as $error)
		<li>{{$error}}</li>
		@endforeach
	</ul>
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>	
	</button>
</div>
@endif

@if(Session::has('success'))
<div class="text-left alert alert-success alert-dismissible fade show">
	<strong>{{Session::get('success')}}</strong>
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>	
	</button>
</div>
@elseif(Session::has('fail'))
<div class="text-left alert alert-danger alert-dismissible fade show">
	<strong>{{Session::get('fail')}}</strong>
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>	
	</button>
</div>
@endif
