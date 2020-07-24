@extends('flowcms::layouts.app')

{{-- CSS & JS for Third Party Libraries --}}
@include('flowcms::partials.css.pickaday')
@include('flowcms::partials.css.quill-editor')
{{-- / CSS & JS for Third Party Libraries --}}

@section('content')
	<div class="bg-gray-800 pb-32">
		<x-flowcms-section-centered class="-mt-8">
			@include('flowcms::partials.cms.admin.navbar')

			@include('flowcms::partials.breadcrumb', [
				'links' => [
					'Dashboard' => url('dashboard'),
					'Articles' => route('flowcms::articles.index'),
					'Current' => $article->uuid,
				]
			])

			@include('flowcms::partials.flash')
		</x-flowcms-section-centered>
	</div>

	<x-flowcms-section-centered class="-mt-48">
		<div class="flex items-center mb-4 justify-between">
			<h2 class="font-bold text-2xl text-white">Edit Article</h2>
		</div>

		<x-flowcms-card>
			<x-flowcms-form action="{{ route('flowcms::articles.update', $article) }}" method="PUT">

				<div class="flex flex-wrap -mx-4">
					<div class="flex-1 px-4">
						<x-flowcms-text-input label="Title" name="title" value="{{ $article->title }}" />

						<div x-data="{ featuredImage: '{{ $article->image }}' }">
							<x-flowcms-text-input
								label="Featured Image"
								x-ref="image"
								name="image"
								value="{{ $article->image }}"
								x-on:input.debounce="featuredImage = $refs.image.value"
								placeholder="eg. https://cdn.pixabay.com/photo/2019/12/21/10/41/african-penguins-4710224_960_720.jpg"
								optional />

							<div x-show="featuredImage != ''" class="mb-5 relative w-64">
								<x-flowcms-close x-on:click="featuredImage = ''; $refs.image.value = ''" />
								<img :src="featuredImage" alt="featuredImage" class="w-64 rounded-lg object-fit">
							</div>
						</div>

						<div @error('body') class="ql-editor-haserror" @enderror>
							<x-flowcms-quill-editor label="Body" name="body" value="{!! $article->body !!}" />
						</div>

						<x-flowcms-text-input label="SEO - Meta Title" name="seo_title" optional />
						<x-flowcms-textarea-input label="SEO - Meta Description" name="seo_description" optional />
					</div>

					<div class="w-full md:w-1/4 px-4">
						<x-flowcms-select-input label="Category" name="category">
							@foreach($categories as $category)
								<option value="{{ $category->id }}"
									{{ $category->id === $article->category_id ? 'selected' : '' }}>{{ Str::title($category->name) }}</option>
							@endforeach
						</x-flowcms-select-input>

						<div class="flex">
							<x-flowcms-switch label="Status" name="status" value="{{ $article->status }}" />
							<div class="ml-2">({{ $article->article_status }})</div>
						</div>

						<x-flowcms-pikaday
							label="Publish date"
							name="publish_date"
							:value="$article->publish_date" />

						<x-flowcms-button type="submit" class="bg-gray-800 text-white">Update Article</x-flowcms-button>
					</div>
				</div>

			</x-flowcms-form>
		</x-flowcms-card>
	</x-flowcms-section-centered>
@endsection
