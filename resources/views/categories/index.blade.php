@extends('flowcms::layouts.app')

@section('content')
	<div class="bg-gray-800 pb-32">
		<x-flowcms-section-centered class="-mt-8">
			@include('flowcms::partials.cms.admin.navbar')

			@include('flowcms::partials.breadcrumb', [
				'links' => [
					'Dashboard' => url('dashboard'),
					'Current' => 'All categories'
				]
			])

			@include('flowcms::partials.flash')
		</x-flowcms-section-centered>
	</div>

	<x-flowcms-section-centered class="-mt-48">
		<div class="flex items-center mb-4 justify-between">
			<h2 class="font-bold text-2xl text-white">Categories</h2>
		</div>

		<x-flowcms-card>
			<div>
				<x-flowcms-form
					action="{{ route('flowcms::categories.store') }}"
					method="POST"
					onsubmit="createCategoryButton.disabled = true; createCategoryButton.classList.add('base-spinner');">
					<div class="flex py-1 space-x-2">
						<div class="w-64">
							<x-flowcms-text-input name="name" placeholder="Category name..." />
						</div>
						<div>
							<x-flowcms-button
								type="submit"
								name="createCategoryButton"
								class="bg-gray-800 text-white shadow">Create</x-flowcms-button>
						</div>
					</div>
				</x-flowcms-form>
			</div>

			@foreach($categories as $category)
				<div class="border-t -mx-5 border-gray-200"></div>
				<div class="relative flex py-4 justify-between" x-data="{showConfirm: false}" x-cloak>
					<div class="md:w-1/4 font-semibold text-gray-800">{{ $category->name }}</div>
					<div class="md:w-1/4 text-gray-600">{{ $category->articles_count }} {{ Str::plural('article',  $category->articles_count) }}</div>
					<div class="md:w-1/4">
						{{-- <a href="{{ route('flowcms::categories.edit', $category->uuid) }}" class="text-blue-600 underline mr-2">Edit</a> --}}

						@if ( $category->slug != 'uncategorized')
							<a
								href="#"
								class="text-red-600 underline"
								x-on:click.prevent="showConfirm = true">Delete</a>

							<div x-show="showConfirm" class="absolute inset-0 bg-gray-200 -mx-5">
								<div class="flex items-center justify-between px-5 py-1">
									<div>
										<h3 class="font-semibold">Delete category {{ $category->name }}?</h3>
										<p class="text-xs truncate">Are you sure you want to delete this category?</p>
									</div>
									<div class="flex items-center pt-1">
										<div>
											<x-flowcms-button type="button" x-on:click="showConfirm = false" class="bg-white text-gray-600 mr-2 shadow-sm">Cancel</x-flowcms-button>
										</div>

										<x-flowcms-form action="{{ route('flowcms::categories.destroy', $category->uuid) }}" method="DELETE">
											<x-flowcms-button type="submit" class="bg-red-500 text-white shadow-sm">Delete</x-flowcms-button>
										</x-flowcms-form>
									</div>
								</div>
							</div>
						@endif
					</div>
				</div>
			@endforeach

		</x-flowcms-card>

	</x-flowcms-section-centered>
@endsection
