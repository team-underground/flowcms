@extends('flowcms::layouts.app')

@section('content')
	<div class="bg-gray-800 pb-32">
		<x-flowcms-section-centered class="-mt-8">
			@include('flowcms::partials.cms.admin.navbar')

			@include('flowcms::partials.breadcrumb', [
				'links' => [
					'Dashboard' => url('dashboard'),
					'Current' => 'Settings',
				]
			])

			@include('flowcms::partials.flash')
		</x-flowcms-section-centered>
	</div>

	<x-flowcms-section-centered class="-mt-48">
		<div class="flex items-center mb-4 justify-between">
			<h2 class="font-bold text-2xl text-white">Site Settings</h2>
		</div>

		<x-flowcms-card>
			<x-flowcms-form action="{{ route('flowcms::settings.store') }}" method="POST">
				@if(count(config('cms_settings', [])) )

					@foreach(collect(config('cms_settings'))->except('site_credential')->toArray() as $section => $fields)
						<div class="flex flex-wrap -mx-4">
							<div class="w-full md:w-1/3 px-4">
								<h2 class="font-bold text-xl text-gray-800">{{ $fields['title'] }}</h2>
								<p class="text-muted mb-4 text-sm">{{ $fields['desc'] }}</p>
							</div>
							<div class="w-full md:w-1/2 px-4">
								@foreach($fields['elements'] as $field)
									@include('flowcms::settings.fields.' . $field['type'] )
								@endforeach
							</div>
						</div>
						<div class="border-b border-gray-200 my-8 -mx-5"></div>
					@endforeach

				@endif

				<div class="text-right">
					<x-flowcms-button type="submit" class="bg-gray-800 text-white">Save Settings</x-flowcms-button>
				</div>
			</x-flowcms-form>
		</x-flowcms-card>
    </x-flowcms-section-centered>
@endsection
