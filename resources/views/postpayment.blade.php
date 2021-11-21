@extends('layouts.app')

@section('title', 'Payment Processing & User Registration')

@section('content')
		<div class="container">
				<div class="row">
					<p>
						{{ $order_existed === true ? 'This transaction has already been recorded in the system. Contact us in case you have not received an email confirmation.' : '' }}
					</p>
				</div>
				<div class="row" style="font-weight: 400;">
						{{-- {{ dd($values) }} --}}
						@foreach ($values as $val)
								<p>{{ $val }}</p>
						@endforeach
				</div>
		</div>

		<h3>
				{{-- Request: {{ dd($value_dump ?? '' ) }} --}}
		</h3>
@endsection
