@extends('layouts.client')
@section('page', __('dashboard.title'))


@section('script')
	<script src="{{ asset('js/app.js') }}"></script>
@endsection

@section('content')

<div class="container">
	<div class="text-center">
		<h2>@lang('app.plan-title')</h2>
		<p>@lang('app.plan-desc')</p>
		<span class="section-title-line"></span>
		<div class="tg-list-item d-flex justify-content-center">
			<div class="d-flex">
				<div id="monthly" class="my-auto text-muted">@lang('app.plan-monthly')</div>
				<div class="pt-2 pl-3 pr-3">
					<label class="switch">
						<input type="checkbox" checked="" id="plantype" name="plantype">
						<div class="slider"></div>
					</label>
				</div>
				<div id="annually" class="my-auto text-primary">@lang('app.plan-annually')</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-4">
				<div class="pricing_item" data="0">
					<h4 class="pt-4"><b>@lang('app.plan-basic')</b></h4>
					<div class="plan-amount">
						<div class="price">
							<del id="basic_old">${{ number_format($plan[0]['price'],2) }}</del>
						</div>
						<div class="price">
							<div class="sup">$</div>
							<div class="monthly-amount" id="basic_price">{{ number_format($plan[1]['price']/12,2) }}</div>
						</div>
						<div class="per-month">@lang('app.plan-month')</div>
					</div>
					<div class="divider"></div>
					<div class="thirty-day">
						<p>@lang('app.plan-note-1')</p>
						<p>@lang('app.plan-note-2-1')</p>
						<p>@lang('app.plan-note-3-1')</p>
						<p>@lang('app.plan-note-4')</p>
					</div>
				</div>
		</div>
		<div class="col-sm-4">
			<div class="pricing_item active" data="1">
				<h4 class="pt-4"><b>@lang('app.plan-plus')</b></h4>
				<div class="plan-amount">
					<div class="price">
						<div class="price">
							<del id="plus_old">${{ number_format($plan[2]['price'],2) }}</del>
						</div>
						<div class="price">
							<div class="sup">$</div>
							<div class="monthly-amount" id="plus_price">{{ number_format($plan[3]['price']/12,2) }}</div>
						</div>
						<div class="per-month">@lang('app.plan-month')</div>
					</div>
				</div>
				<div class="divider"></div>
				<div class="thirty-day">
					<p>@lang('app.plan-note-1')</p>
					<p>@lang('app.plan-note-2-3')</p>
					<p>@lang('app.plan-note-3-2')</p>
					<p>@lang('app.plan-note-4')</p>
				</div>
				<div class="savings" id="basic_saving"></div>
			</div>
		</div>
		<div class="col-sm-4">
				<div class="pricing_item" data="2">
					<h4 class="pt-4"><b>@lang('app.plan-pro')</b></h4>
					<div class="plan-amount">
						<div class="price">
							<div class="price">
								<del id="pro_old">${{ number_format($plan[4]['price'],2) }}</del>
							</div>
							<div class="price">
								<div class="sup">$</div>
								<div class="monthly-amount" id="pro_price">{{ number_format($plan[5]['price']/12,2) }}</div>
							</div>
						</div>

						<div class="per-month">@lang('app.plan-month')</div>
					</div>
					<div class="divider"></div>
					<div class="thirty-day">
						<p>@lang('app.plan-note-1')</p>
						<p>@lang('app.plan-note-2-8')</p>
						<p>@lang('app.plan-note-3-2')</p>
						<p>@lang('app.plan-note-4')</p>
					</div>
					<div class="savings" id="basic_saving"></div>
				</div>
		</div>
	</div>
</div>
	<script type="json" id="data">
		@php
			echo json_encode($plan)
		@endphp
	</script>
@endsection