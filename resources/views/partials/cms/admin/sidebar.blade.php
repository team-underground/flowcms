<div class="md:hidden">
	{{-- Overlay --}}
	<div x-on:click="open = false" class="fixed inset-0 z-30 bg-gray-600 opacity-0 pointer-events-none transition-opacity ease-linear duration-300" :class="{'opacity-75 pointer-events-auto': open, 'opacity-0 pointer-events-none': !open}"></div>

	<div class="fixed inset-y-0 left-0 flex flex-col z-40 max-w-xs w-full bg-white transform ease-in-out duration-300 -translate-x-full" :class="{'translate-x-0': open, '-translate-x-full': !open}">
		{{-- Brand/Logo --}}
		<div class="flex items-center px-8 py-3 h-16">
			<a href="{{ url('/') }}" class="inline-flex items-center">
				@if(setting('site_logo') != '')
					<img src="{{ setting('site_logo') }}" alt="{{ setting('site_name') }}" class="object-contain">
				@else
					<span class="text-gray-800 font-bold text-xl tracking-tight">{{ setting('site_name') }}</span>
				@endif
			</a>
		</div>

		<div class="px-4 py-2 flex-1 h-0 overflow-y-auto">
			{{-- Normal Links --}}
			<x-flowcms-nav-item to="/" class="flex items-center py-2">
				<span class="w-6 h-6 mr-4 text-gray-500">@svg(url('/cms/icons/home.svg'))</span>Home
			</x-flowcms-nav-item>

			<x-flowcms-nav-item to="{{ route('flowcms::blog') }}" class="flex items-center py-2">
				<span class="w-6 h-6 mr-4 text-gray-500">@svg(url('/cms/icons/document-duplicate.svg'))</span> Blog
			</x-flowcms-nav-item>

			@foreach($pages as $page)
				<x-flowcms-nav-item to="{{ url($page->slug) }}" class="flex items-center py-2">
					<span class="w-6 h-6 mr-4 text-gray-500">@svg(url('/cms/icons/document.svg'))</span> {{ Str::title($page->title) }}
				</x-flowcms-nav-item>
			@endforeach

			{{-- Admin Links--}}
			@auth
			<div class="text-xs uppercase text-gray-500 font-semibold tracking-wider mb-2 mt-5 pl-5">Admin</div>
			<x-flowcms-nav-item to="{{ route('flowcms::dashboard') }}" class="flex items-center py-2">
				<span class="w-6 h-6 mr-4 text-gray-500">@svg(url('/cms/icons/clipboard-list.svg'))</span> Dashboard
			</x-flowcms-nav-item>
			<x-flowcms-nav-item to="{{ route('flowcms::articles.create') }}" class="flex items-center py-2">
				<span class="w-6 h-6 mr-4 text-gray-500">@svg(url('/cms/icons/pencil-alt.svg'))</span> New Article
			</x-flowcms-nav-item>
			<x-flowcms-nav-item to="{{ route('flowcms::contacts') }}" class="flex items-center py-2">
				<span class="w-6 h-6 mr-4 text-gray-500">@svg(url('/cms/icons/annotation.svg'))</span> Contacts
			</x-flowcms-nav-item>
			<x-flowcms-nav-item to="{{ route('flowcms::pages.index') }}" class="flex items-center py-2">
				<span class="w-6 h-6 mr-4 text-gray-500">@svg(url('/cms/icons/document.svg'))</span> Pages
			</x-flowcms-nav-item>
			<x-flowcms-nav-item to="{{ route('flowcms::articles.index') }}" class="flex items-center py-2">
				<span class="w-6 h-6 mr-4 text-gray-500">@svg(url('/cms/icons/document-duplicate.svg'))</span> Articles
			</x-flowcms-nav-item>
			<x-flowcms-nav-item to="{{ route('flowcms::media') }}" class="flex items-center py-2">
				<span class="w-6 h-6 mr-4 text-gray-500">@svg(url('/cms/icons/photograph.svg'))</span> Media
			</x-flowcms-nav-item>
			<x-flowcms-nav-item to="{{ route('flowcms::categories.index') }}" class="flex items-center py-2">
				<span class="w-6 h-6 mr-4 text-gray-500">@svg(url('/cms/icons/bookmark.svg'))</span> Categories
			</x-flowcms-nav-item>
			<x-flowcms-nav-item to="{{ route('flowcms::seo.index') }}" class="flex items-center py-2">
				<span class="w-6 h-6 mr-4 text-gray-500">@svg(url('/cms/icons/globe.svg'))</span> Seo
			</x-flowcms-nav-item>

			<x-flowcms-nav-item to="{{ route('flowcms::profile') }}" class="flex items-center py-2">
				<span class="w-6 h-6 mr-4 text-gray-500">@svg(url('/cms/icons/user.svg'))</span> Profile
			</x-flowcms-nav-item>
			<x-flowcms-nav-item to="{{ route('flowcms::settings') }}" class="flex items-center py-2">
				<span class="w-6 h-6 mr-4 text-gray-500">@svg(url('/cms/icons/cog.svg'))</span> Settings
			</x-flowcms-nav-item>
			<x-flowcms-nav-item to="#" class="flex items-center py-2" onclick="event.preventDefault(); document.getElementById('js-sidebar-logout').submit()">
				<span class="w-6 h-6 mr-4 text-gray-500">@svg(url('/cms/icons/logout.svg'))</span> Log out
			</x-flowcms-nav-item>

			<x-flowcms-form method="POST" action="{{ route('flowcms::logout') }}" id="js-sidebar-logout"></x-flowcms-form>
			@endauth
		</div>
	</div>
</div>
