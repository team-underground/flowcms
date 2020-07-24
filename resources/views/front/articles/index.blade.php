@extends('flowcms::layouts.front')

@section('content')
	<div class="bg-transparent">
		<div class="md:max-w-6xl md:mx-auto pt-2 px-4">
			@include('flowcms::partials.cms.admin.navbarInverse')
		</div>
	</div>

	<x-flowcms-section-centered>

		<div x-data="{
				page: new URLSearchParams(location.search).get('page') || 0,
				fetchArticles(url = null) {
					const URL = url || '/partials/blog?page=' + this.page;
					fetch(URL)
						.then(response => response.text())
						.then(html => {
							document.querySelector('#js-articles').innerHTML = html
						})
				}
			}"
			x-init="
				fetchArticles();
				$watch('page', (value) => {
					const url = new URL(window.location.href);
					url.searchParams.set('page', value);
					history.pushState(null, document.title, url.toString());
				})"
			x-cloak>
			<div class="flex flex-wrap -mx-4">
				<div class="px-4 w-full md:w-3/4">
					<div id="js-articles">
						@include('flowcms::front.articles.articlesLoader')
					</div>

					<div class="my-10">{{ $articles->links('flowcms::partials.tailwindPagination') }}</div>
				</div>
				<div class="px-4 w-full md:w-1/4">

					<a class="mb-6 block" href="https://github.com/team-underground/flowcms" target="_blank">
						<img src="/cms/banner-medium-rectangle.png" alt="Flowcms" class="rounded-lg" loading="lazy">
					</a>

					<a class="mb-6 block" href="https://github.com/team-underground/flowcms" target="_blank">
						<img src="/cms/banner-medium-rectangle4.png" alt="Flowcms" class="rounded-lg" loading="lazy">
					</a>

				</div>
			</div>
		</div>
	</x-flowcms-section-centered>
@endsection
