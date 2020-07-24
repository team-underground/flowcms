@extends('flowcms::layouts.app')

@section('content')
	<div class="bg-gray-800 pb-32">
		<x-flowcms-section-centered class="-mt-8">
			@include('flowcms::partials.cms.admin.navbar')

			@include('flowcms::partials.breadcrumb', [
				'links' => [
					'Dashboard' => url('dashboard'),
					'Current' => 'Seo',
				]
			])

			@include('flowcms::partials.flash')
		</x-flowcms-section-centered>
	</div>

	<x-flowcms-section-centered class="-mt-48">
		<div class="flex items-center mb-4 justify-between">
			<h2 class="font-bold text-2xl text-white">Seo for Pages</h2>
		</div>

		@forelse($pages as $page)
			<x-flowcms-card class="mb-6">
				<h2 class="font-bold text-xl text-gray-800 mb-2">{{ $page->title }}</h2>

				<x-flowcms-form
					action="{{ route('flowcms::pages.update', $page) }}"
					method="PUT">

					<x-flowcms-text-input
						label="Seo Title"
						name="seo_title"
						value="{{ $page->seo_title }}"
						optional />

					<x-flowcms-textarea-input
						label="Seo Description"
						name="seo_description"
						value="{{ $page->seo_description }}"
						optional />

					<x-flowcms-button
						type="submit"
						class="bg-gray-800 text-white"
						name="update">Update</x-flowcms-button>
				</x-flowcms-form>
			</x-flowcms-card>
		@empty
			<x-flowcms-alert :close="false">No page found.</x-flowcms-alert>
		@endforelse
	</x-flowcms-section-centered>
@endsection
