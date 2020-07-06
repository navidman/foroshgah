@extends('profile.layout')


@section('main')
	
	<h5>two factor auth:</h5>
	<hr>

	@if($errors->any())
		<div class="alert alert-danger">
			<ul>
				@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif


	<form action="" method="POST">
		@csrf
		<div class="form-group">
			<label for="type">Type</label>
			<select name="type" id="type" class="form-controll">
				<option value="off">off</option>
				<option value="sms">sms</option>
			</select>
		</div>
		<div class="form-group">
			<label for="phone">Phone</label>
			<input type="text" name="phone" id="phone" class="form-controll" placeholder="phone number">
		</div>
		<div class="form-group">
			<button class="btn btn-primary">
				Update
			</button>
		</div>


	</form>

@endsection