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

<x-flowcms-section-centered class="-mt-48"
	x-data="{
		query: new URLSearchParams(location.search).get('s') || '',
		fetchMedias(url = null) {
			const URL = url || '/partials/media?s=' + this.query;
			fetch(URL)
				.then(response => response.text())
				.then(html => {
					document.querySelector('#js-medias-wrapper').innerHTML = html
				})
		}
	}"
	x-init="
		fetchMedias();
		$watch('query', (value) => {
			console.log(value);
			const url = new URL(window.location.href);
			url.searchParams.set('s', value);
			history.pushState(null, document.title, url.toString());
		})
	"
	x-cloak
	@reload.window="fetchMedias()">

	<div class="flex items-center mb-4 justify-between">
		<h2 class="font-bold text-2xl text-white">All Medias</h2>
	</div>

    <div class="mb-6 rounded-lg overflow-hidden shadow-xs">
		<x-flowcms-uppy endpoint="{{ route('flowcms::media.store') }}" />
	</div>

	<x-flowcms-card>
		<div class="pt-4">
			<x-flowcms-search-input
				placeholder="Search images by name..."
				name="s"
				x-model="query"
				x-on:input.debounce.750="fetchMedias()" />
		</div>
		<div id="js-medias-wrapper">
			@include('flowcms::media._media')
		</div>
	</x-flowcms-card>
 </x-flowcms-section-centered>
@endsection
