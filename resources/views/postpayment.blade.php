@extends('layouts.app')

@section('title', 'Payment Processing & User Registration')

@section('content')
	<div class="container">
		@if (isset($error) && $error === 'true')
				<div class="row">
					<div class="col">
						<h3 class="text-center">
							<i class="fas fa-exclamation-triangle text-danger">
						</h3>
						<p class="text-center text-muted">
							An error occured. Please contact <a class="link-primary"
							href="mailto:info@moworx.co.ke"
							style="color:  #8ec444 !important; text-decoration: underline;">info@moworx.co.ke</a>, or <a class="link-primary"
							href="https://wa.me/254780154423"
							style="color:  #8ec444 !important; text-decoration: underline;"><i class="fab fa-whatsapp-square"></i> 0780 154 423</a> for assitance.
						</p>
					</div>
				</div>
		@else
			@if ($order_existed === true)
				<div class="row">
					<p>
						This transaction has already been recorded in the system. Contact <a class="link-primary"
							href="mailto:info@moworx.co.ke"
							style="color:  #8ec444 !important; text-decoration: underline;">info@moworx.co.ke</a> in case you have not
						received an email confirmation.
					</p><br>
				</div>
			@else
				@if ($mail_response === 'success')
					<div class="row">
						<div class="col text-center">
							<h5 class="text-muted">
								Successfully registered <i class="fas fa-user-check" style="color: #8ec444;"></i> <br />
								Your login credentials have been sent to you. <strong>Check your spam folder.</strong>
							</h5>
						</div>
					</div>
					<div class="col text-center">
						<h3><i class="fas fa-envelope fa-3x" style="color:#8ec444;"></i></h3>
					</div><br>
				@elseif ($mail_response === 'failed')
					<div class="row">
						<div class="col text-center">
							<h5 class="text-muted">
								<i class="fas fa-exclamation-triangle text-danger"></i> An error occured. Please contact <a class="link-primary"
									href="mailto:info@moworx.co.ke"
									style="color:  #8ec444 !important; text-decoration: underline;">info@moworx.co.ke</a> or <a class="link-primary"
									href="https://wa.me/254780154423"
									style="color:  #8ec444 !important; text-decoration: underline;"><i class="fab fa-whatsapp-square"></i> 0780 154 423</a> for assistance.
							</h5>
						</div>
					</div>
				@endif
				<div class="row" style="font-weight: 400;">
					<p class="text-center text-muted">
						{!! $values['state'] !!}<br>
						{!! $values['message'] !!}
					</p>
					<table class="table table-borderless table-hover">
						<thead>
							<tr>
								<th scope="col" colspan="2">Invoice #: <span class="text-secondary">{{ $values['invoiceId'] }}</span></strong>
								</th>
							</tr>
						</thead>
						<tbody class="text-muted">
							<tr>
								<th scope="row"></th>
								<td>Customer</td>
								<td>
									<strong class="text-muted">
										{{ $values['first_name'] }} {{ $values['last_name'] }}<br />
										{{ $values['email'] }}
									</strong>
								</td>
							</tr>
							<tr>
								<th scope="row"></th>
								<td>Product Name:</td>
								<td><strong class="text-muted">{{ $values['productName'] }}</strong></td>
							</tr>
						</tbody>
						<tfoot>
							<td></td>
							<td>
								<hr /><strong>Total:</strong>
							</td>
							<td>
								<hr /><strong class="text-muted">{{ $values['cost'] }}</strong>
							</td>
						</tfoot>
					</table>
				</div>
				<div class="row">
					<div class="col text-center">
						<p class="text-center">Login in to the <a class="link-primary" href="{{ $values['dashboard'] }}"
								style="color:  #8ec444 !important; text-decoration: underline;">dashboard</a> to access <b
								style="color:  #8ec444 !important;">{{ $values['productName'] }}</b>.</p>
					</div>
				</div>
				<br>
			@endif
		@endif
		
	</div>
@endsection