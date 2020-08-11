@if($articles->isNotEmpty())
	@foreach($articles as $article)
		<div class="mb-1 md:mb-8 md:px-4 w-full">
			<x-flowcms-card class="flex flex-wrap md:items-center overflow-hidden -mx-4">
				<div class="w-full px-4 flex-1">
					<div class="py-2">
						<div class="mb-2 flex items-center text-sm md:text-base">
							<x-flowcms-link to="#">{{ $article->category->name }}</x-flowcms-link>
							<div class="mx-3 text-gray-500 h-8 border-r" style="transform: rotate(15deg)"></div>
							<div>{{ $article->publish_date->format('d M Y') }}</div>
							<div class="mx-3 text-gray-500 h-8 border-r" style="transform: rotate(15deg)"></div>
							<div>By <x-flowcms-link to="#">{{ Str::title($article->user->name) }}</x-flowcms-link></div>
						</div>

						<a href="{{ route('flowcms::blog.show', $article->slug) }}" class="inline-block text-2xl md:text-3xl text-gray-800 hover:text-indigo-600 heading leading-tight font-normal mb-3 transition ease-out duration-300">
							{{ $article->title }}
						</a>

						@php $limit = $article->image ? 150 : 250; @endphp
						<div class="text-sm md:text-base">{{ Str::limit(strip_tags($article->body), $limit) }}</div>
					</div>

					<div class="mt-auto pt-2 pb-4 text-sm md:text-base">
						<x-flowcms-link to="{{ route('flowcms::blog.show', $article->slug) }}">Read more <span class="w-4 h-4 inline-block mt-px">@svg(url('cms/icons/chevron-right.svg'))</span></x-flowcms-link>
					</div>
				</div>

				@if($article->image)
					<div class="w-full md:w-2/5 order-first sm:order-last px-4">
						<div class="relative bg-indigo-200 md:rounded-lg -mx-10 -mt-5 md:m-auto pb-48 md:pb-48">
							<picture>
								<source media="(min-width: 500px)"
										srcset="{{ $article->images['medium'] }}" />
								<source media="(max-width: 500px)"
										srcset="{{ $article->images['small'] }}" />

								<img
									src="{{ $article->image }}"
									alt="Article Image"
									loading="lazy"
									class="z-10 md:rounded-lg shadow-xs md:shadow absolute inset-0 w-full h-full object-cover object-left-top">
							</picture>
						</div>
					</div>
				@endif
			</x-flowcms-card>
		</div>
	@endforeach

	<div class="border-t border-gray-200 pt-2 my-8 -mx-4">
		{{ $articles->onEachSide(2)->links('flowcms::partials.tailwindPaginationAlpinejs') }}   
	</div>
@else
	<div class="px-4 py-10">
		No articles found.
	</div>
@endif
