@extends('layouts.client')
@section('page', __('client.acc-title'))


@section('content')

<h2 class="mt-4">@lang('client.acc-title')</h2>
<div class="row">
	<div class="col-md-6">
		<form class="mt-5" action="{{ route('account.passwd') }}" method="POST">
			@csrf
			<div class="field-row ">
				<div class="label-vertical form-group">
					<label for="passwd" class="control-label requiredField">@lang('client.acc-oldpasswd')</label>
					<div class="controls controls-vertical">
						<input autocomplete="off" value="{{ old('passwd') }}" required="" class="input-small textinput textInput form-control" id="passwd" name="passwd" placeholder="@lang('client.acc-oldpasswd')" minlength="6" maxlength="32" type="password">
					</div>
					@if($errors->has('passwd'))
						<p class="helper text-danger">{{ $errors->first('passwd') }}</p>
					@endif
				</div>
			</div>
			<hr>
			<div class="field-row ">
				<div class="label-vertical form-group">
					<label for="newpasswd" class="control-label requiredField">@lang('client.acc-newpasswd')</label>
					<div class="controls controls-vertical">
						<input autocomplete="off" value="{{ old('newpasswd') }}" required="" class="input-small textinput textInput form-control" id="newpasswd" name="newpasswd" placeholder="@lang('client.acc-newpasswd')" minlength="6" maxlength="32" type="password">
					</div>
					@if($errors->has('newpasswd'))
						<p class="helper text-danger">{{ $errors->first('newpasswd') }}</p>
					@endif
				</div>
			</div>
			<div class="field-row ">
				<div class="label-vertical form-group">
					<label for="confirmpasswd" class="control-label requiredField">@lang('auth.confirm')</label>
					<div class="controls controls-vertical">
						<input autocomplete="off" value="{{ old('confirm') }}" required="" class="input-small textinput textInput form-control" id="confirmpasswd" name="confirmpasswd" placeholder="@lang('auth.confirm')" minlength="6" maxlength="32" type="password" value="">
					</div>
					@if($errors->has('confirmpasswd'))
						<p class="helper text-danger">{{ $errors->first('confirmpasswd') }}</p>
					@endif
				</div>
			</div>
			<button type="submit" class="btn btn-primary">@lang('app.submit')</button>
		</form>
			
	</div>
</div>

@endsection