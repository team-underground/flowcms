<div class="md:flex md:items-center md:justify-between border-b border-gray-300 relative" x-data="{open: false }" x-cloak>
	<div class="flex justify-between flex-1 pb-2 md:pb-0 items-center">
		<a href="{{ url('/') }}" class="inline-flex items-center">
			@if(setting('site_logo') != '')
				<img src="{{ setting('site_logo') }}" alt="{{ setting('site_name') }}" class="object-contain" loading="lazy">
			@else
				<span class="text-gray-800 font-bold text-xl md:text-2xl tracking-tight">{{ setting('site_name') }}</span>
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
			<x-flowcms-navbar-link to="/">Home</x-flowcms-navbar-link>

			@if(setting('site_homepage_url') !== 'blog')
				<x-flowcms-navbar-link to="blog">Blog</x-flowcms-navbar-link>
			@endif

			@foreach($pages as $page)
				<x-flowcms-navbar-link to="{{ $page->slug }}">{{ Str::title($page->title) }}</x-flowcms-navbar-link>
			@endforeach

			@guest
				@if(setting('login_text'))
					<div class="py-3">
						<a data-turbolinks="false" href="{{ url( setting('login_url') ) }}" class="font-medium bg-gray-800 text-white rounded-lg px-4 py-2 inline-flex">{{ setting('login_text') }}</a>
					</div>
				@endif
			@endguest

			@auth
				<div class="py-3">
					@include('flowcms::partials.cms.admin.dropdown')
				</div>
			@endauth
		</div>
	</div>
</div>
