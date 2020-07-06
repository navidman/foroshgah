@extends('layouts.app')


@section('content')

	<div class="container">
	    <div class="row justify-content-center">
	        <div class="col-md-8">
	            <div class="card">
	                <div class="card-header">
	                <ul class="nav nav-pills card-header-pills">
	                	<li class="nav-item">
	                		<a class="nav-link {{ request()-> path() === 'profile' ? 'active' : '' }}" href="{{ route('profile') }}">Index</a>
	                	</li>
	                	<li class="nav-item">
	                		<a class="nav-link {{ request()-> is('profile/two-factor-auth') ? 'active' : '' }}" href="{{ route('two.factor.auth') }}">TwoFactorAuth</a>
	                	</li>
	                </ul>
	                </div>

	                <div class="card-body">
	                	@yield('main')
	                </div>
	            </div>
	        </div>
	    </div>
	</div>

@endsection