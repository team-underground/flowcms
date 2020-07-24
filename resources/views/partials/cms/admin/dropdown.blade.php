<x-flowcms-dropdown alignment="right">
	<x-slot name="trigger">
		<button class="relative w-8 h-8 text-gray-600 rounded-full border bg-gray-100 font-semibold focus:outline-none focus:shadow-outline text-sm overflow-hidden">
			<img src="{{ auth()->user()->avatarUrl() }}" alt="Profile Photo" class="absolute inset-0 h-full w-full object-cover">
		</button>
	</x-slot>

	<div class="text-gray-600 text-sm truncate px-4 py-2">Hi, {{ auth()->user()->name }}</div>
	<x-flowcms-dropdown-item to="{{ route('flowcms::dashboard') }}" class="flex items-center">
		<span class="flex-shrink-0 w-5 h-5 mr-2 text-gray-500">@svg(url('/cms/icons/clipboard-list.svg'))</span> Dashboard
	</x-flowcms-dropdown-item>
	<x-flowcms-dropdown-item to="{{ route('flowcms::contacts') }}" class="flex items-center">
		<span class="flex-shrink-0 w-5 h-5 mr-2 text-gray-500">@svg(url('/cms/icons/annotation.svg'))</span> Contacts
	</x-flowcms-dropdown-item>
	<x-flowcms-dropdown-item to="{{ route('flowcms::articles.create') }}" class="flex items-center">
		<span class="flex-shrink-0 w-5 h-5 mr-2 text-gray-500">@svg(url('/cms/icons/pencil-alt.svg'))</span> New Article
	</x-flowcms-dropdown-item>
	<x-flowcms-dropdown-item to="{{ route('flowcms::profile') }}" class="flex items-center">
		<span class="flex-shrink-0 w-5 h-5 mr-2 text-gray-500">@svg(url('/cms/icons/user.svg'))</span> Profile
	</x-flowcms-dropdown-item>
	<x-flowcms-dropdown-item to="{{ route('flowcms::settings') }}" class="flex items-center">
		<span class="flex-shrink-0 w-5 h-5 mr-2 text-gray-500">@svg(url('/cms/icons/cog.svg'))</span> Settings
	</x-flowcms-dropdown-item>
	<x-flowcms-dropdown-item to="#" class="flex items-center" onclick="event.preventDefault(); document.getElementById('js-logout').submit()">
		<span class="flex-shrink-0 w-5 h-5 mr-2 text-gray-500">@svg(url('/cms/icons/logout.svg'))</span> Log out
	</x-flowcms-dropdown-item>

	<x-flowcms-form method="POST" action="{{ route('flowcms::logout') }}" id="js-logout"></x-flowcms-form>
</x-flowcms-dropdown>
