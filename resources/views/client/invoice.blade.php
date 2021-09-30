@extends('layouts.client')
@section('page', __('client.inv-title'))


@section('script')
	<script src="{{ asset('js/jquery.qrcode.js') }}"></script>
	<script src="{{ asset('js/deposit.js') }}"></script>
@endsection


@section('content')

<h3>@lang('client.inv-title')</h3>
<table class="table">
	<thead>
		<tr>
			<th class="text-center"></th>
			<th class="text-center">@lang('client.inv-header-date')</th>
			<th class="text-center">@lang('client.inv-header-amount')</th>
			<th class="text-center">@lang('client.inv-header-desc')</th>
			<th class="text-center">@lang('client.inv-header-status')</th>
		</tr>
	</thead>
	<tbody>
		@foreach($rows as $r)
			<tr>
				<td class="text-center">#{{ $r->id }}</td>
				<td class="text-center">{{ $r->updated_at }}</td>
				<td class="text-center">{{ $r->price }}$ ({{ App\Helper::btc($r->btc) }}$)</td>
				<td class="text-center">{{ $r->note }}</td>
				<td class="text-center">{{ App\Orders::status($r->status) }}</td>
			</tr>
		@endforeach
	</tbody>
</table>

@endsection