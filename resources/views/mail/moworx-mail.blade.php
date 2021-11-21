{{-- @extends('layouts.app') --}}

@component('mail::message')
		# Introduction

		Thank you for registering with Moworx kenya<br>

		<h1>{{ $details['title'] }}</h1>
		<p>{{ $details['test'] }}</p>

		@component('mail::button', ['url' => env('DASHBOARD_URL')])
				Login to the dashboard
		@endcomponent

		Thanks,<br>
		{{ config('app.name') }}
@endcomponent
