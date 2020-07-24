@extends('flowcms::layouts.app')

@section('content')
	<div class="bg-gray-800 pb-32">
		<x-flowcms-section-centered class="-mt-8">
			@include('flowcms::partials.cms.admin.navbar')

			@include('flowcms::partials.breadcrumb', [
				'links' => [
					'Dashboard' => url('dashboard'),
					'Pages' => route('flowcms::pages.index'),
					'Current' => $page->title
				]
			])

			@include('flowcms::partials.flash')
		</x-flowcms-section-centered>
	</div>

	<x-flowcms-section-centered class="-mt-48">
		<div class="flex items-center mb-4 justify-between">
			<h2 class="font-bold text-2xl text-white">Edit {{ $page->title }} Page</h2>

			<div>
				<a href="{{ route('flowcms::pages.show', $page) }}" target="_blank" class="text-white bg-indigo-600 font-semibold px-4 py-2 rounded-lg hover:bg-indigo-700 inline-flex items-center">
					<span class="w-5 h-5 mr-1">@svg(url('/cms/icons/eye.svg'))</span>
					Preview
				</a>


				{{-- <div>
					<x-flowcms-dropdown alignment="right">
						<x-slot name="trigger">
							<button class="w-6 h-6 text-gray-600">
								Add Blocks
							</button>
						</x-slot>

						<x-flowcms-dropdown-item to="{{ route('flowcms::pages.index') }}">All Pages</x-flowcms-dropdown-item>
						<x-flowcms-dropdown-item to="{{ route('flowcms::pages.create') }}">New Page</x-flowcms-dropdown-item>
						<x-flowcms-dropdown-item to="{{ route('flowcms::pages.show', $page) }}">Preview</x-flowcms-dropdown-item>
					</x-flowcms-dropdown>
				</div> --}}
			</div>
		</div>

		{{-- Page Form --}}
		<div class="mb-6 bg-white rounded-lg shadow p-4">
			<x-flowcms-form action="{{ route('flowcms::pages.update', $page) }}" method="PUT">
				<x-flowcms-text-input
					placeholder="Page Title"
					type="text"
					name="title"
					value="{{ $page->title }}" />

				<x-flowcms-text-input
					placeholder="Display Title"
					type="text"
					name="display_title"
					value="{{ $page->display_title }}" />

				<x-flowcms-textarea-input
					placeholder="Page Content..."
					name="body"
					value="{{ $page->body }}" />

				<div class="md:w-48">
					<x-flowcms-select-input label="Select template" name="template">
						<option value="page" {{ $page->template == 'page' ? 'selected' : '' }}>Page</option>
						<option value="landing" {{ $page->template == 'landing' ? 'selected' : '' }}>Landing</option>
					</x-flowcms-select-input>
				</div>

				<div class="flex">
					<x-flowcms-switch
						label="Show on Menu"
						name="show_on_menu"
						value="{{ $page->show_on_menu }}" />
				</div>

				<div class="flex">
					<x-flowcms-switch
						label="Deactivate Page"
						name="active"
						value="{{ $page->active }}" />
				</div>


				<x-flowcms-button
					type="submit"
					class="bg-gray-800 text-white">Update</x-flowcms-button>
			</x-flowcms-form>
		</div>
		{{-- ./ Page Form --}}

		{{-- Order Blocks --}}
		@if ($page->template === 'page' && $page->blocks->isNotEmpty())
			<h3 class="mb-2 font-bold text-gray-800">Order Blocks</h3>

			<div x-data="{ pages: {{ $page->layout === null ? '[]' : collect(explode(',', $page->layout)) }} }" x-cloak class="mb-4">
				<x-flowcms-card>
					<div class="flex flex-wrap -mx-4">
						<div class="w-full md:w-1/3 px-4 mb-5 md:mb-0">
							<label class="mb-2 text-gray-800 font-semibold block">Blocks Order</label>
							<template x-for="(page, index) in pages" :key="index">
								<div>
									<div x-show="index != 0" class="ml-px h-6 w-1 bg-gray-200 rounded-lg"></div>
									<div class="flex items-center">
										<div class="-ml-px mr-4 w-2 h-2 rounded-full bg-indigo-500"></div>
										<div class="flex">
											<div x-text="`${index + 1}.`" class="mr-2 text-gray-800 font-bold"></div>
											<div x-text="page" class="text-gray-700"></div>
										</div>
									</div>
								</div>
							</template>
						</div>
						<div class="w-full md:w-2/3 px-4">
							<x-flowcms-form action="{{ route('flowcms::pages.update', $page) }}" method="PUT">

								<label class="mb-2 text-gray-800 font-semibold block">Blocks order</label>
								{{-- <div x-html="pages" class="px-2 py-2 h-10 bg-white rounded-lg shadow-sm border mb-4"></div> --}}

								<input type="hidden" name="layout" :value="pages" readonly>
								<div class="flex w-full flex-wrap mb-5">

									@foreach (collect($page->blocks->unique('type'))->flatten()->pluck('type') as $index => $block)
										<label
											class="md:w-1/2 flex flex-1 justify-start items-center text-truncate hover:bg-gray-100 px-2 py-2">
											<div class="text-gray-800 mr-2">
												<input
													id="checkbox-{{ $block }}"
													type="checkbox"
													class="form-checkbox focus:outline-none focus:shadow-outline"
													x-model="pages"
													{{ collect(explode(',', $page->layout))->contains($block) === true ? 'checked' : '' }}
													value="{{ $block }}">
											</div>
											<div class="select-none text-gray-700">
												{{ Str::title($block) }}
											</div>
										</label>
									@endforeach
								</div>

								<x-flowcms-button
									x-show="pages.length > 0"
									type="submit"
									class="bg-gray-800 text-white">Update Block Order</x-flowcms-button>
							</x-flowcms-form>
						</div>
					</div>
				</x-flowcms-card>
			</div>
		@endif

		{{-- Select Page --}}
		@if ($page->template === 'landing')
			<h3 class="mb-2 font-bold text-gray-800">Add Page</h3>

			<div x-data="{ pages: {{ $page->layout === null ? '[]' : collect(explode(',', $page->layout)) }} }" x-cloak class="mb-4">
				<x-flowcms-card>
					<div class="flex flex-wrap -mx-4">
						<div class="w-full md:w-1/3 px-4 mb-5 md:mb-0">
							<label class="mb-2 text-gray-800 font-semibold block">Landing Page Order</label>
							<template x-for="(page, index) in pages" :key="index">
								<div>
									<div x-show="index != 0" class="ml-px h-6 w-1 bg-gray-200 rounded-lg"></div>
									<div class="flex items-center">
										<div class="-ml-px mr-4 w-2 h-2 rounded-full bg-indigo-500"></div>
										<div class="flex">
											<div x-text="`${index + 1}.`" class="mr-2 text-gray-800 font-bold"></div>
											<div x-text="page" class="text-gray-700"></div>
										</div>
									</div>
								</div>
							</template>
						</div>
						<div class="w-full md:w-2/3 px-4">
							<x-flowcms-form action="{{ route('flowcms::pages.update', $page) }}" method="PUT">

								<label class="mb-2 text-gray-800 font-semibold block">Selected pages</label>
								{{-- <div x-html="pages" class="px-2 py-2 h-10 bg-white rounded-lg shadow-sm border mb-4"></div> --}}

								<input type="hidden" name="layout" :value="pages" readonly>
								<div class="flex flex-wrap mb-5">

									@foreach ($otherPages as $otherPage)
										@foreach($otherPage->blocks->unique('type') as $index => $block)
											<label
												class="md:w-1/2 flex justify-start items-center text-truncate hover:bg-gray-100 px-2 py-2">
												<div class="text-gray-800 mr-2">
													@php
														$pageName = $block->type . '-' . $block->page_id;
													@endphp
													<input
														id="checkbox-{{ $block->page_id }}"
														type="checkbox"
														class="form-checkbox focus:outline-none focus:shadow-outline"
														x-model="pages"
														{{ collect(explode(',', $page->layout))->contains($pageName) === true ? 'checked' : '' }}
														value="{{ $block->type }}-{{ $block->page_id }}">
												</div>
												<div class="select-none text-gray-700">
													{{ $otherPage->title }} ({{ $block->type }})
												</div>
											</label>
										@endforeach
									@endforeach
								</div>

								<x-flowcms-button
									x-show="pages.length > 0"
									type="submit"
									class="bg-gray-800 text-white">Add Page</x-flowcms-button>
							</x-flowcms-form>
						</div>
					</div>
				</x-flowcms-card>
			</div>
		@endif

		@if($blocks->isNotEmpty())

			@php $availableBlocks = collect(config('cms.blocks'))->keys() @endphp

			<div class="flex flex-wrap -mx-4 mb-5">
				@foreach($blocks as $block)
					@if ($availableBlocks->contains($block->type))
						<div class="w-full md:w-1/3 px-4">
							<div class="bg-white rounded-lg overflow-hidden shadow mb-4">
								<div class="px-4 py-1 bg-gray-100 uppercase text-xs tracking-wider font-semibold text-gray-800">{{ $block->type }}</div>
								<div class="p-4">
									@include('flowcms::partials.cms.blockForm', [
										'block' => $block,
										'update' => route('flowcms::blocks.update', $block->id),
										'delete' => route('flowcms::blocks.destroy', $block),
										'icons' => $icons
									])
								</div>
							</div>
						</div>
					@endif
				@endforeach
			</div>

			{{-- Services Blocks --}}
			{{-- <div class="flex flex-wrap -mx-4 mb-5">
				@foreach($blocks as $block)
					@if ($block->type === 'services')
						<div class="w-full md:w-1/3 px-4">
							<div class="bg-white rounded-lg overflow-hidden shadow mb-4">
								<div class="px-4 py-1 bg-gray-100 uppercase text-xs tracking-wider font-semibold text-gray-800">{{ $block->type }}</div>
								<div class="p-4">
									@include('flowcms::partials.cms.blockForm', [
										'block' => $block,
										'update' => route('flowcms::blocks.update', $block->id),
										'delete' => route('flowcms::blocks.destroy', $block),
										'icons' => $icons
									])
								</div>
							</div>
						</div>
					@endif
				@endforeach
			</div> --}}

			{{-- CTA Blocks --}}
			{{-- <div class="flex flex-wrap -mx-4 mb-5">
				@foreach($blocks as $block)
					@if ($block->type === 'cta')
						<div class="w-full px-4">
							<div class="bg-white rounded-lg overflow-hidden shadow mb-4">
								<div class="px-4 py-1 bg-gray-100 uppercase text-xs tracking-wider font-semibold text-gray-800">{{ $block->type }}</div>
								<div class="p-4">
									@include('flowcms::partials.cms.blockForm', [
										'block' => $block,
										'update' => route('flowcms::blocks.update', $block->id),
										'delete' => route('flowcms::blocks.destroy', $block)
									])
								</div>
							</div>
						</div>
					@endif
				@endforeach
			</div> --}}

			{{-- Hero Blocks --}}
			{{-- <div class="flex flex-wrap -mx-4 mb-5">
				@foreach($blocks as $block)
					@if ($block->type === 'hero' || $block->type === 'hero_image_left' || $block->type === 'hero_image_right')
						<div class="w-full px-4">
							<div class="bg-white rounded-lg overflow-hidden shadow mb-4">
								<div class="px-4 py-1 bg-gray-100 uppercase text-xs tracking-wider font-semibold text-gray-800">{{ $block->type }}</div>
								<div class="p-4">
									@include('flowcms::partials.cms.blockForm', [
										'block' => $block,
										'update' => route('flowcms::blocks.update', $block->id),
										'delete' => route('flowcms::blocks.destroy', $block)
									])
								</div>
							</div>
						</div>
					@endif
				@endforeach
			</div> --}}

			{{-- Testimonial Blocks --}}
			{{-- <div class="flex flex-wrap -mx-4 mb-5">
				@foreach($blocks as $block)
					@if ($block->type === 'testimonial')
						<div class="w-full px-4">
							<div class="bg-white rounded-lg overflow-hidden shadow mb-4">
								<div class="px-4 py-1 bg-gray-100 uppercase text-xs tracking-wider font-semibold text-gray-800">{{ $block->type }}</div>
								<div class="p-4">
									@include('flowcms::partials.cms.blockForm', [
										'block' => $block,
										'update' => route('flowcms::blocks.update', $block->id),
										'delete' => route('flowcms::blocks.destroy', $block)
									])
								</div>
							</div>
						</div>
					@endif
				@endforeach
			</div> --}}
		@endif

		<h3 class="mb-2 font-bold text-gray-800">Add Blocks</h3>
		<div class="flex flex-wrap -mx-2">
			@foreach($blockButtons as $blockButton)
				<div class="px-2 mb-4">
					<x-flowcms-form action="{{ route('flowcms::blocks.store') }}" method="POST">
						<input type="hidden" name="page_id" value="{{ $page->id }}">
						<input type="hidden" name="type" value="{{ $blockButton }}">
						<x-flowcms-button type="submit" class="bg-white shadow-sm text-gray-600">{{ Str::studly($blockButton) }}</x-flowcms-button>
					</x-flowcms-form>
				</div>
			@endforeach
		</div>
	</x-flowcms-section-centered>
@endsection
