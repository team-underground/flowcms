@extends('flowcms::layouts.app')

@section('title')
Profile
@stop

@section('content')
<div class="bg-gray-800 pb-32">
	<x-flowcms-section-centered class="-mt-8">
		@include('flowcms::partials.cms.admin.navbar')

		@include('flowcms::partials.breadcrumb', [
			'links' => [
				'Dashboard' => url('dashboard'),
				'Current' => 'Profile'
			]
		])

		@include('flowcms::partials.flash')
	</x-flowcms-section-centered>
</div>

<x-flowcms-section-centered class="-mt-48">
	<div class="flex items-center mb-4 justify-between">
		<h2 class="font-bold text-2xl text-white">Profile Settings</h2>
	</div>

    <x-flowcms-card>
		<div class="flex flex-wrap -mx-4">
			<div class="w-full md:w-1/3 px-4">
				<h2 class="font-bold text-xl text-gray-800">Account Details</h2>
				<p class="text-muted mb-4 text-sm"></p>
			</div>
			<div class="w-full md:w-1/2 px-4">
				<x-flowcms-form action="{{ route('flowcms::profile.update') }}" method="POST" class="md:max-w-md">
					<x-flowcms-text-input type="text" label="Name" name="name" value="{{ auth()->user()->name }}" />
					<x-flowcms-text-input type="email" label="Email" name="email" value="{{ auth()->user()->email }}" />
					<x-flowcms-text-input type="password" label="New Password" name="password" />
					<x-flowcms-text-input type="password" label="Confirm New Password" name="password_confirmation" />
					<x-flowcms-button type="submit" class="bg-gray-800 justify-center text-white">Update</x-flowcms-button>
				</x-flowcms-form>
			</div>
		</div>
	</x-flowcms-card>
 </x-flowcms-section-centered>
@endsection
