@extends('flowcms::layouts.front')

@section('content')
	<div class="bg-transparent">
		<div class="md:max-w-6xl md:mx-auto pt-2 px-4">
			@include('flowcms::partials.cms.admin.navbarInverse')
		</div>
	</div>

	<x-flowcms-section-centered>

		<div 
			x-ref="articles"
			x-data="{
				loading: false,
				query: new URLSearchParams(location.search).get('s') || '',
		
				fetchData(page = null) {
					this.loading = true;
					let currentPageFromUrl = location.search.match(/page=(\d+)/) 
									? location.search.match(/page=(\d+)/)[1] 
									: 1
		
					if (this.query) {
						currentPageFromUrl = 1;
						history.pushState(null, null, '?page=1&s='+ this.query);
					}
		
					const endpointURL =  page !== null 
								? `${page}&s=${this.query}` 
								: `/blog?page=${currentPageFromUrl}&s=${this.query}`;
		
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
							this.loading = false;
							document.querySelector('#js-articles').innerHTML = html;
							this.$refs.articles.scrollIntoView({behaviour: 'smooth'});
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
			<div class="flex flex-wrap -mx-4">
				<div class="px-4 w-full md:w-3/4 -mt-10 md:mt-auto">
					<div x-show="loading">
						@include('flowcms::front.articles._articlesLoader')
					</div>
					<div id="js-articles" x-show="! loading">
						@include('flowcms::front.articles._articles')
					</div>
				</div>
				<div class="px-4 w-full md:w-1/4">
					<div class="flex flex-row md:flex-col space-x-4 md:space-x-0">
						<a class="mb-6 block" href="https://github.com/team-underground/flowcms" target="_blank">
							<img src="/cms/banner-medium-rectangle.png" alt="Flowcms" class="rounded-lg" loading="lazy">
						</a>

						<a class="mb-6 block" href="https://github.com/team-underground/flowcms" target="_blank">
							<img src="/cms/banner-medium-rectangle4.png" alt="Flowcms" class="rounded-lg" loading="lazy">
						</a>
					</div>
				</div>
			</div>
		</div>
	</x-flowcms-section-centered>
@endsection
