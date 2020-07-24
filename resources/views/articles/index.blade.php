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

		<div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative"
			x-data="{
				query: new URLSearchParams(location.search).get('s') || '',
				fetchArticles(url = null) {
					const URL = url || '/partials/articles?s=' + this.query;
					fetch(URL)
					.then(response => response.text())
					.then(html => {
						document.querySelector('#js-article-body').innerHTML = html
					})
				}
			}"
			x-init="
				fetchArticles();
				$watch('query', (value) => {
					console.log(value);
					const url = new URL(window.location.href);
					url.searchParams.set('s', value);
					history.pushState(null, document.title, url.toString());
				})
			"
			x-cloak
			@reload.window="fetchArticles()"
		>
			<div class="px-5 pt-4">
				<x-flowcms-search-input placeholder="Search article..." name="s" x-model="query" x-on:input.debounce.750="fetchArticles()" />
			</div>
			<table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
				<thead>
					<tr class="text-left">
						<x-flowcms-table.head>Title</x-flowcms-table.head>
						<x-flowcms-table.head>Views</x-flowcms-table.head>
						<x-flowcms-table.head>Category</x-flowcms-table.head>
						<x-flowcms-table.head>Published Date</x-flowcms-table.head>
						<x-flowcms-table.head>Status</x-flowcms-table.head>
					</tr>
				</thead>
				<tbody id="js-article-body"></tbody>
			</table>
		</div>

		<div class="my-10">{{ $articles->links('flowcms::partials.tailwindPagination') }}</div>
	</x-flowcms-section-centered>
@endsection
