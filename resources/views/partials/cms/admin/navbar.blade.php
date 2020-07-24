<div class="md:flex md:items-center md:justify-between border-b mb-5" style="border-color: rgba(255, 255, 255, 0.08)" x-data="{open: false }" x-cloak>
	<div class="flex justify-between flex-1 pb-2 md:pb-0 items-center">
        <a href="{{ url('/') }}" class="inline-flex items-center">
			@if(setting('site_logo_white') != '' && file_exists(setting('site_logo_white')))
				<img src="{{ setting('site_logo_white') }}" alt="{{ setting('site_name') }}" class="object-contain">
			@else
				<span class="text-gray-100 font-bold text-xl md:text-2xl tracking-tight">{{ setting('site_name') }}</span>
			@endif
		</a>

		<button
			x-on:click="open = ! open"
			class="rounded-lg focus:outline-none focus:shadow-outline w-10 h-10 p-1 md:hidden">
			@svg(url('/cms/icons/menu.svg'))
		</button>
	</div>

	{{-- Small Menu --}}
	@include('flowcms::partials.cms.admin.sidebar')

	{{-- Large Menu --}}
	<div class="hidden md:block">
		<div class="flex space-x-8 items-center">
			<x-flowcms-navbar-link variant="dark" to="/">Home</x-flowcms-navbar-link>

			@auth
				<x-flowcms-navbar-link variant="dark" to="pages">Pages</x-flowcms-navbar-link>
				<x-flowcms-navbar-link variant="dark" to="articles/all">Articles</x-flowcms-navbar-link>
				<x-flowcms-navbar-link variant="dark" to="categories">Categories</x-flowcms-navbar-link>
				<x-flowcms-navbar-link variant="dark" to="seo">SEO</x-flowcms-navbar-link>
				<x-flowcms-navbar-link variant="dark" to="media">Media</x-flowcms-navbar-link>

				<div class="py-3">
					@include('flowcms::partials.cms.admin.dropdown')
				</div>
			@endauth
		</div>
	</div>
</div>
