@extends('flowcms::layouts.app')

@section('content')
	<div class="bg-gray-800 pb-32">
		<x-flowcms-section-centered class="-mt-8">
			@include('flowcms::partials.cms.admin.navbar')

			@include('flowcms::partials.breadcrumb', [
				'links' => [
					'Dashboard' => url('dashboard'),
					'Current' => 'All articles'
				]
			])

			@include('flowcms::partials.flash')
		</x-flowcms-section-centered>
	</div>

	<x-flowcms-section-centered class="-mt-48">
		<div class="flex items-center mb-4 justify-between">
			<h2 class="font-bold text-2xl text-white">Articles</h2>
			<a href="{{ route('flowcms::articles.create')}}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 rounded-lg text-gray-100 font-semibold">New Article</a>
		</div>

		<div
			x-data="{
				query: new URLSearchParams(location.search).get('s') || '',

				fetchData(page = null) {
					let currentPageFromUrl = location.search.match(/page=(\d+)/) 
									? location.search.match(/page=(\d+)/)[1] 
									: 1

					if (this.query) {
						currentPageFromUrl = 1;
						history.pushState(null, null, '?page=1&s='+ this.query);
					}

					const endpointURL =  page !== null 
								? `${page}&s=${this.query}` 
								: `/articles/all?page=${currentPageFromUrl}&s=${this.query}`;

					if (page) {
						const urlObj = new URL(page);
						const params = new URLSearchParams(urlObj.search);
						history.pushState(null, null, '?page=' + params.get('page') );
					}

					fetch(endpointURL, {
							headers: {
								'X-Requested-With': 'XMLHttpRequest'
							}
						})
						.then(response => response.text())
						.then(html => {
							document.querySelector('#js-articles-body').innerHTML = html
						})
				}
			}"
			x-init="
				$watch('query', (value) => {
					const url = new URL(window.location.href);
					url.searchParams.set('s', value);
					history.pushState(null, document.title, url.toString());
				})

				document.addEventListener('keypress',(e) => {
					if (event.code == 'Slash') {
						event.preventDefault();
						$refs.searchInput.focus();
					}
				});
			"
			@goto-page="fetchData($event.detail.page)"
			@reload.window="fetchData()"
			x-cloak>

			<div class="my-4">
				<x-flowcms-search-input
					placeholder='Search articles (Press "/" to focus)'
					name="s" 
					x-model="query" 
					x-ref="searchInput"
					x-on:input.debounce.750="fetchData()" />
			</div>

			<div id="js-articles-body">
				@include('flowcms::articles._articles')
			</div>
		</div>
	</x-flowcms-section-centered>
@endsection
