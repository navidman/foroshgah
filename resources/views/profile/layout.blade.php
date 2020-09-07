@extends('layouts.app')


@section('content')

	<div class="container">
	    <div class="row justify-content-center">
	        <div class="col-md-8">
	            <div class="card">
	                <div class="card-header">
	                <ul class="nav nav-pills card-header-pills" style="float: right;">
	                	<li class="nav-item">
	                		<a class="nav-link {{ request()-> path() === 'profile' ? 'active' : '' }}" href="{{ route('profile') }}">پروفایل</a>
	                	</li>
	                	<li class="nav-item">
	                		<a class="nav-link {{ request()-> is('profile/two-factor-auth') ? 'active' : '' }}" href="{{ route('two.factor.auth') }}">احراز هویت دو مرحله ای</a>
	                	</li>
	                	<li class="nav-item">
	                		<a class="nav-link {{ request()-> is('profile/orders') ? 'active' : '' }}" href="{{ route('profile.orders') }}">سفارشات</a>
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