@extends('flowcms::layouts.app')

@section('title')
Media
@stop

@section('content')
<div class="bg-gray-800 pb-32">
	<x-flowcms-section-centered class="-mt-8">
		@include('flowcms::partials.cms.admin.navbar')

		@include('flowcms::partials.breadcrumb', [
			'links' => [
				'Dashboard' => url('dashboard'),
				'Current' => 'Medias'
			]
		])

		@include('flowcms::partials.flash')
	</x-flowcms-section-centered>
</div>

<x-flowcms-section-centered 
	class="-mt-48"
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
						: `/media?page=${currentPageFromUrl}&s=${this.query}`;

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
					document.querySelector('#js-medias-wrapper').innerHTML = html
				})
		}
	}"
	x-init="
		$watch('query', (value) => {
			const url = new URL(window.location.href);
			url.searchParams.set('s', value);
			history.pushState(null, document.title, url.toString());
		});
		document.addEventListener('keypress',(e) => {
			if (event.code == 'Slash') {
				event.preventDefault();
				$refs.searchInput.focus();
			}
		});
	"
	@goto-page="fetchData($event.detail.page)"
	x-cloak
	@reload.window="fetchData()">

	<div class="flex items-center mb-4 justify-between">
		<h2 class="font-bold text-2xl text-white">All Medias</h2>
	</div>

    <div class="mb-6 rounded-lg overflow-hidden shadow-xs">
		<x-flowcms-uppy endpoint="{{ route('flowcms::media.store') }}" />
	</div>

	<x-flowcms-card>
		<div class="pt-4">
			<x-flowcms-search-input
				placeholder='Search images (Press "/" to focus)'
				name="s"
				x-ref="searchInput"
				x-model="query"
				x-on:input.debounce.750="fetchData()" />
		</div>
		<div id="js-medias-wrapper">
			@include('flowcms::media._media')
		</div>
	</x-flowcms-card>
 </x-flowcms-section-centered>
@endsection
