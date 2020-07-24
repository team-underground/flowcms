@extends('flowcms::layouts.app')

@section('content')
	<x-flowcms-toastr />

	<div class="bg-gray-800 pb-32">
		<x-flowcms-section-centered class="-mt-8">
			@include('flowcms::partials.cms.admin.navbar')

			@include('flowcms::partials.breadcrumb', [
				'links' => [
					'Dashboard' => url('dashboard'),
					'Current' => 'All contacts'
				]
			])

			@include('flowcms::partials.flash')
		</x-flowcms-section-centered>
	</div>

	<x-flowcms-section-centered class="-mt-48">
		<div class="flex items-center mb-4 justify-between">
			<h2 class="font-bold text-2xl text-white">Contacts</h2>
		</div>

		<div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative"
			x-data="{
				query: new URLSearchParams(location.search).get('s') || '',
				fetchContacts(url = null) {
					const URL = url || '/partials/contacts?s=' + this.query;
					fetch(URL)
					.then(response => response.text())
					.then(html => {
						document.querySelector('#js-contact-body').innerHTML = html
					})
				}
			}"
			x-init="
				fetchContacts();
				$watch('query', (value) => {
					console.log(value);
					const url = new URL(window.location.href);
					url.searchParams.set('s', value);
					history.pushState(null, document.title, url.toString());
				})
			"
			x-cloak
			@reload.window="fetchContacts()"
		>
			<div class="px-5 pt-4">
				<x-flowcms-search-input placeholder="Search contacts..." name="s" x-model="query" x-on:input.debounce.750="fetchContacts()" />
			</div>
			<table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
				<thead>
					<tr class="text-left">
						<x-flowcms-table.head>From</x-flowcms-table.head>
						<x-flowcms-table.head>Message</x-flowcms-table.head>
						<x-flowcms-table.head>Action</x-flowcms-table.head>
					</tr>
				</thead>
				<tbody id="js-contact-body"></tbody>
			</table>
		</div>

		<div class="my-10">{{ $contacts->links('flowcms::partials.tailwindPagination') }}</div>
	</x-flowcms-section-centered>
@endsection
