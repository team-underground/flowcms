@extends('flowcms::layouts.app')

@section('content')
	<div class="bg-gray-800 pb-32">
		<x-flowcms-section-centered class="-mt-8">
			@include('flowcms::partials.cms.admin.navbar')

			<div class="text-gray-500">Welcome back, {{ auth()->user()->name }}</div>

			@include('flowcms::partials.flash')
		</x-flowcms-section-centered>
	</div>

	<x-flowcms-section-centered class="-mt-48">
		<div class="flex items-center mb-4 justify-between">
			<h2 class="font-bold text-2xl text-white">Dashboard</h2>
		</div>

		<div class="flex flex-wrap -mx-4">
			<div class="w-1/2 md:w-1/4 px-4 py-2">
				<x-flowcms-card class="py-10 md:py-5 md:h-40 text-center">
					<h2 class="text-4xl md:text-6xl truncate text-gray-800 font-bold tracking-tighter leading-tight">{{ $articlesCount }}</h2>
					<p class="uppercase tracking-wider text-sm font-semibold text-gray-600">
						{{ Str::plural('article', $articlesCount) }}
					</p>
				</x-flowcms-card>
			</div>
			<div class="w-1/2 md:w-1/4 px-4 py-2">
				<x-flowcms-card class="py-10 md:py-5 md:h-40 text-center">
					<h2 class="text-4xl md:text-6xl truncate text-gray-800 font-bold tracking-tighter leading-tight">{{ $categoriesCount }}</h2>
				<p class="uppercase tracking-wider text-sm font-semibold text-gray-600">{{ Str::plural('category', $categoriesCount) }}</p>
				</x-flowcms-card>
			</div>
			<div class="w-1/2 md:w-1/4 px-4 py-2">
				<x-flowcms-card class="py-10 md:py-5 md:h-40 text-center">
					<h2 class="text-4xl md:text-6xl truncate text-gray-800 font-bold tracking-tighter leading-tight">{{ $pagesCount }}</h2>
					<p class="uppercase tracking-wider text-sm font-semibold text-gray-600">{{ Str::plural('page', $pagesCount) }}</p>
				</x-flowcms-card>
			</div>
			<div class="w-1/2 md:w-1/4 px-4 py-2">
				<x-flowcms-card class="py-10 md:py-5 md:h-40 text-center">
				<h2 class="text-4xl md:text-6xl truncate text-gray-800 font-bold tracking-tighter leading-tight">{{ $viewCount }}</h2>
					<p class="uppercase tracking-wider text-sm font-semibold text-gray-600">Articles {{ Str::plural('view', $pagesCount) }}</p>
				</x-flowcms-card>
			</div>
		</div>

		<div class="border-b mt-10 mb-6 relative">
			<div class="font-semibold absolute left-0 right-0 -mt-2 leading-tight w-32 text-center uppercase tracking-widest text-xs text-gray-500 mx-auto bg-gray-200">&lt;Quick Menu&gt;</div>
		</div>
		<div class="flex flex-wrap -mx-4">
			<div class="w-1/2 md:w-1/4 py-2 px-4">
				<x-flowcms-card class="py-8 hover:bg-indigo-100">
					<a href="{{ route('flowcms::articles.create') }}" class="block flex items-center justify-center">
						<div>
							<div class="w-12 h-12 p-2 rounded-full bg-indigo-100 mb-4 mx-auto">
								<div class="w-8 h-8 text-indigo-600">@svg(url('/cms/icons/pencil-alt.svg'))</div>
							</div>

							<div class="uppercase tracking-wider text-sm font-semibold text-gray-600">New Article</div>
						</div>
					</a>
				</x-flowcms-card>
			</div>
			<div class="w-1/2 md:w-1/4 py-2 px-4">
				<x-flowcms-card class="py-8 hover:bg-indigo-100">
					<a href="{{ route('flowcms::categories.index') }}" class="block flex items-center justify-center">
						<div>
							<div class="w-12 h-12 p-2 rounded-full bg-indigo-100 mb-4 mx-auto">
								<div class="w-8 h-8 text-indigo-600">@svg(url('/cms/icons/bookmark.svg'))</div>
							</div>

							<div class="uppercase tracking-wider text-sm font-semibold text-gray-600">New Category</div>
						</div>
					</a>
				</x-flowcms-card>
			</div>
			<div class="w-1/2 md:w-1/4 py-2 px-4">
				<x-flowcms-card class="py-8 hover:bg-indigo-100">
					<a href="{{ route('flowcms::pages.index') }}" class="block flex items-center justify-center">
						<div>
							<div class="w-12 h-12 p-2 rounded-full bg-indigo-100 mb-4 mx-auto">
								<div class="w-8 h-8 text-indigo-600">@svg(url('/cms/icons/document.svg'))</div>
							</div>

							<div class="uppercase tracking-wider text-sm font-semibold text-gray-600">New Page</div>
						</div>
					</a>
				</x-flowcms-card>
			</div>
			<div class="w-1/2 md:w-1/4 py-2 px-4">
				<x-flowcms-card class="py-8 hover:bg-indigo-100">
					<a href="{{ route('flowcms::settings') }}" class="block flex items-center justify-center">
						<div>
							<div class="w-12 h-12 p-2 rounded-full bg-indigo-100 mb-4 mx-auto">
								<div class="w-8 h-8 text-indigo-600">@svg(url('/cms/icons/cog.svg'))</div>
							</div>

							<div class="uppercase tracking-wider text-sm font-semibold text-gray-600">Settings</div>
						</div>
					</a>
				</x-flowcms-card>
			</div>
		</div>

	</x-flowcms-section-centered>
@endsection
