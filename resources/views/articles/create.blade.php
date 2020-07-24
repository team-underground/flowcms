@extends('flowcms::layouts.app')

{{-- CSS & JS for Third Party Libraries --}}
@include('flowcms::partials.css.pickaday')
@include('flowcms::partials.css.quill-editor')
{{-- / CSS & JS for Third Party Libraries --}}

@section('content')
	<div class="bg-gray-800 pb-32">
		<x-flowcms-section-centered  class="-mt-8">
			@include('flowcms::partials.cms.admin.navbar')

			@include('flowcms::partials.breadcrumb', [
				'links' => [
					'Dashboard' => url('dashboard'),
					'Articles' => route('flowcms::articles.index'),
					'Current' => 'Create Article',
				]
			])

			@include('flowcms::partials.flash')
		</x-flowcms-section-centered>
	</div>

	<x-flowcms-section-centered class="-mt-48">
		<div class="flex items-center mb-4 justify-between">
			<h2 class="font-bold text-2xl text-white">New Article</h2>
		</div>

		<x-flowcms-card>
			<x-flowcms-form action="{{ route('flowcms::articles.store') }}" method="POST">

				<div class="flex flex-wrap -mx-4">
					<div class="flex-1 px-4">
						<x-flowcms-text-input label="Title" name="title" />

						<div x-data="{ featuredImage: '' }">
							<x-flowcms-text-input
								optional
								label="Featured Image"
								x-ref="image"
								name="image"
								placeholder="eg. https://cdn.pixabay.com/photo/2019/12/21/10/41/african-penguins-4710224_960_720.jpg"
								x-on:input.debounce="featuredImage = $refs.image.value" />

							<div x-show="featuredImage != ''" class="mb-5 relative w-64">
								<x-flowcms-close x-on:click="featuredImage = ''; $refs.image.value = ''" />
								<img :src="featuredImage" alt="featuredImage" class="w-64 rounded-lg object-fit">
							</div>
						</div>

						<div @error('body') class="ql-editor-haserror" @enderror>
							<x-flowcms-quill-editor label="Body" name="body" value="" />
						</div>

						<x-flowcms-text-input label="SEO - Meta Title" name="seo_title" optional />
						<x-flowcms-textarea-input label="SEO - Meta Description" name="seo_description" optional />

					</div>

					<div class="w-full md:w-1/4 px-4">
						<x-flowcms-select-input label="Category" name="category">
							@foreach($categories as $category)
								<option value="{{ $category->id }}">{{ Str::title($category->name) }}</option>
							@endforeach
						</x-flowcms-select-input>

						<x-flowcms-switch label="Status" name="status" :value="false"/>
						<x-flowcms-pikaday label="Publish date" name="publish_date" value="{{ now() }}" />

						<x-flowcms-button type="submit" class="bg-gray-800 text-white">Save Article</x-flowcms-button>

					</div>
				</div>

			</x-flowcms-form>
		</x-flowcms-card>
	</x-flowcms-section-centered>
@endsection
