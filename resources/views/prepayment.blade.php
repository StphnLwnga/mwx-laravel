@extends('layouts.app')

@section('title', 'Transferring to payment gateway')

@section('content')
		<div class="container">
				<div class="row">
						<div class="col text-center">
							<i class="fas fa-spinner"></i>
						</div>
				</div>
				<div class="row" style="text-align: center;">
						{{-- {{ dd($fields) }} --}}
						<div class="col">
								<form id="pay_now" action="{{ $pay_url }}">
										<button id="proceed-to-pay" class="btn btn-light text-light" type="submit">
												Proceed
										</button>
										@foreach ($fields as $key => $val)
												<input name="{{ $key }}" type="hidden" value="{{ $val }}" />
										@endforeach
								</form>
						</div>
				</div>
		</div>
@endsection

@section('preprocess_script')
		<script async defer type="text/javascript">
		  (function($) {
		    $(document).ready(function() {
		      $("#pay_now").submit();
		    });
		  })(jQuery);
		</script>
@endsection
