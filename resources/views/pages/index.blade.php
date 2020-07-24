@extends('flowcms::layouts.app')

@section('content')
	<div class="bg-gray-800 pb-32">
		<x-flowcms-section-centered class="-mt-8">
			@include('flowcms::partials.cms.admin.navbar')

			@include('flowcms::partials.breadcrumb', [
				'links' => [
					'Dashboard' => url('dashboard'),
					'Current' => 'Pages'
				]
			])

			@include('flowcms::partials.flash')
		</x-flowcms-section-centered>
	</div>

	<x-flowcms-section-centered class="-mt-48">
		<h2 class="font-bold text-2xl mb-4 text-white">All pages</h2>

		<x-flowcms-card>
			<x-flowcms-form action="{{ route('flowcms::pages.store') }}" method="POST">
				<div class="flex py-1 space-x-2">
					<div class="w-64">
						<x-flowcms-text-input name="title" placeholder="Page title" />
					</div>
					<div>
						<x-flowcms-button type="submit" class="bg-gray-800 text-white shadow">Create</x-flowcms-button>
					</div>
				</div>
			</x-flowcms-form>

			@if ($pages->isNotEmpty())
				@foreach($pages as $page)
					<div class="border-t -mx-5 border-gray-200"></div>
					<div class="flex py-4 justify-between relative" x-data="{ showConfirm: false }" x-cloak>
						<div class="md:w-1/4 font-semibold text-gray-800">{{ $page->title }}</div>
						<div class="md:w-1/4 text-gray-600">/{{ $page->slug }}</div>
						<div class="md:w-1/4 text-gray-600"><code class="text-xs rounded-full text-red-500 bg-gray-100 p-1">{{ $page->template }}.blade.php</code></div>
						<div>
							<a href="{{ route('flowcms::pages.edit', $page->slug) }}" class="text-indigo-600 underline mr-2">Edit</a>
							<a href="{{ route('flowcms::pages.show', $page) }}" class="text-indigo-600 underline mr-2">Preview</a>
							<a href="#" class="text-red-600 underline" x-on:click.prevent="showConfirm = true">Delete</a>
						</div>
						<div x-show="showConfirm" class="absolute inset-0 bg-gray-200 -mx-5">
							<div class="flex items-center justify-between px-5 py-1">
								<div>
									<h3 class="font-semibold">Delete page {{ $page->title }}?</h3>
									<p class="text-xs truncate">All blocks associated with this page will also get deleted.</p>
								</div>
								<div class="flex items-center pt-1">
									<div>
										<x-flowcms-button type="button" x-on:click="showConfirm = false" class="bg-white text-gray-600 mr-2 shadow-sm">Cancel</x-flowcms-button>
									</div>

									<x-flowcms-form action="{{ route('flowcms::pages.destroy', $page) }}" method="DELETE">
										<x-flowcms-button type="submit" class="bg-red-500 text-white shadow-sm">Delete</x-flowcms-button>
									</x-flowcms-form>
								</div>
							</div>
						</div>
					</div>

				@endforeach
			@else
				<div class="border-t -mx-5 border-gray-200 py-10">
					<p class="text-center">No pages created yet.</p>
				</div>
			@endif
		</x-flowcms-card>
	</x-flowcms-section-centered>

@endsection
