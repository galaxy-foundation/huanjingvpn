@extends('layouts.extra')
@section('page', __('app.title'))

@section('content')

<div class="page-header">
	<div class="row">
		<div class="col-12 text-center">
			<h1>Easy Balance</h1>
			<p>Check balance of multiple addresses</p>
		</div>
	</div>
</div>
<form action="{{ route('bitcoin.balance.submit') }}" method="post">
	@csrf
	<div class="container">
		<div class="row">
			<div class="col-12 text-center">
				<h4>Please enter addresses</h4>
				<span>(One address per line)</span>
			</div>
		</div>
		<div class="row">
			<div class="col-12 text-center">
				@if(isset($rows))
					<table class="table">
					@foreach($rows as $row)
						<tr>
							<td class="text-monospace">{{$row[0]}}</td>
							<td class="text-right">{{ App\Helper::btc($row[1]) }}</td>
						</tr>
					@endforeach
					</table>
				@else
				<textarea class="text-monospace form-control" rows="12" name="data"></textarea>
				@endif
			</div>
		</div>
		<div class="row">
			<div class="col-12 text-center">
				<button class="btn btn-success">Get Balance</button>
			</div>
		</div>
		
	</div>
</form>

@endsection