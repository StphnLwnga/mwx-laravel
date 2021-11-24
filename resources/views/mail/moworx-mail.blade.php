@extends('layouts.mail')

@section('content')
		@if (isset($details['dashboard']) && isset($details['password']))
			<div class="container">
				<div class="row text-center">
						<div class="col text-center">
								<p>Thank you for registering. Use your email, to log in to the <a class="link-primary" href="{{ $details['dashboard'] }}"
												style="color:  #8ec444 !important; text-decoration: underline;">dashboard</a> and access <b style="color:  #8ec444 !important;">{{$details['productName']}}</b>.</p>.<br>
								<p>Password: <strong style="color:#8EC444;">{{ $details['password'] }}</strong></p>
						</div>
				</div>
		@elseif (isset($details['paid']) && isset($details['orderId']) && isset($details['invoiceId']) && isset($details['channel']) && isset($details['cost']))
			<div class="container">
				<div class="row">
					<div class="col">
						<table class="table table-borderless table-hover">
							<thead>
								<tr>
									<th scope="col" colspan="2">Invoice #: <span class="text-secondary">{{ $details['invoiceId'] }}</span></strong>
									</th>
								</tr>
							</thead>
							<tbody class="text-muted">
								<tr>
									<th scope="row"></th>
									<td>Customer</td>
									<td>
										<strong class="text-muted">
											{{ $details['name'] }}<br />
											{{ $details['email'] }}
										</strong>
									</td>
								</tr>
								<tr>
									<th scope="row"></th>
									<td>Order ID:</td>
									<td><strong class="text-muted">{{ $details['orderId'] }}</strong></td>
								</tr>
								<tr>
									<th scope="row"></th>
									<td>Product Name:</td>
									<td><strong class="text-muted">{{ $details['productName'] }}</strong></td>
								</tr>
								<tr>
									<th scope="row"></th>
									<td>Cost:</td>
									<td><strong class="text-muted">{{ $details['cost'] }}</strong></td>
								</tr>
							</tbody>
							<tfoot>
								<td></td>
								<td>
									<hr /><strong>Total:</strong>
								</td>
								<td>
									<hr /><strong class="text-muted">{{ $details['cost'] }}</strong>
								</td>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		@endif

		{{-- test --}}

@endsection
