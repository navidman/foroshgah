@extends('layouts.app')


@section('content')

	<div class="container">
	    <div class="row justify-content-center">
	        <div class="col-md-8">
	            <div class="card">
	                <div class="card-header">
	                	Two factor Authenticate
	                </div>

	                <div class="card-body">
	                	<form action="{{ route('two.factor.auth.token') }}" method="POST" class="">
	                		@csrf
	                		<div class="form-group">
	                			<label for="token" class="col-form-label">Token</label>
	                			<input type="text" name="token" class="form-control @error('token') is-invalid @enderror" placeholder="enter your token" value="">
	          
	                			@error('token')
	                				<span class="invalid-feedback">
	                					<strong>{{ $message }}</strong>
	                				</span>
	                			@enderror
	                		</div>
	                		<div class="form-group">
	                			<button class="btn btn-primary">Validate token</button>
	                		</div>
	                	</form>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>

@endsection