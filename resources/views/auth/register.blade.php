@extends('layouts.app')
@section('title',__('auth.register'))
@section('content')
<section class="content">
	<div class="container-login100">
		
		<div class="login">
			<h2 class="text-white text-center"><a class="h2" href="{{ route('index') }}">@lang('app.title')</a> @lang('auth.register')</h2><hr>
			<div class="dialog">
				<form class="galaxy" action="{{ route('register.submit' ) }}" method="post">
					@csrf
					<input type="text" value="{{ old('name') }}" required="" style="width:100%" name="name" placeholder="@lang('auth.username')" minlength="3" maxlength="20" pattern="^[a-zA-Z0-9\-_]+$" autocomplete="off">
					@if($errors->has('name'))
						<p class="helper text-danger">{{ $errors->first('name') }}</p>
					@endif
					<p class="helper">@lang('auth.characters'): [ a-z, A-Z, 0-9 ] { 3-20 }</p>
					<input type="password" value="{{ old('passwd') }}" required="" style="width:100%" name="passwd" placeholder="@lang('auth.password')" minlength="6" maxlength="32" pattern="^[ -~]+$" autocomplete="off">
					@if($errors->has('passwd'))
						<p class="helper text-danger">{{ $errors->first('passwd') }}</p>
					@endif
					<p class="helper">6-32 @lang('auth.characters').</p>
					<input type="password" value="{{ old('confirmpasswd') }}" required="" style="width:100%" name="confirmpasswd" placeholder="@lang('auth.confirm')" minlength="6" maxlength="32" pattern="^[ -~]+$" autocomplete="off">
					@if($errors->has('confirmpasswd'))
						<p class="helper text-danger">{{ $errors->first('confirmpasswd') }}</p>
					@endif
					<input type="text" value="{{ old('captcha') }}" required="" style="width:100%" name="captcha" placeholder="@lang('auth.captcha')" minlength="6" maxlength="6" pattern="^[0-9]+$" autocomplete="off">
					@if($errors->has('captcha'))
						<p class="helper text-danger">{{ $errors->first('captcha') }}</p>
					@endif
					<div><img src="{{route('captcha')}}?e={{ time() }}"></div>
					<button style="margin-top:8px" type="submit" class="w-100 btn--raised ripple">@lang('auth.register')</button>
				</form>
				<div style="text-align:center;margin-top:12px">
					<p class="helper" style="display:inline-block"><span>@lang('auth.haveaccount') <a href="{{route('login')}}"><span>@lang('auth.login')</span></a></span></p>
				</div>
			</div>
		</div>
	</div>
</section>
@stop