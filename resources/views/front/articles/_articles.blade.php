@forelse($articles as $article)
	<div class="mb-6 md:mb-8 md:px-4 w-full">
		<x-flowcms-card class="flex flex-wrap md:items-center overflow-hidden -mx-4">
			<div class="w-full px-4 {{ $article->image ? 'md:w-2/3' : '' }}">
				<div class="py-2">
					<div class="mb-2 flex items-center text-sm md:text-base">
						<x-flowcms-link to="#">{{ $article->category->name }}</x-flowcms-link>
						<div class="mx-3 text-gray-500 h-8 border-r" style="transform: rotate(15deg)"></div>
						<div>{{ $article->publish_date->format('d M Y') }}</div>
						<div class="mx-3 text-gray-500 h-8 border-r" style="transform: rotate(15deg)"></div>
						<div class="my-3">By <x-flowcms-link to="#">{{ Str::title($article->user->name) }}</x-flowcms-link></div>
					</div>

					<a href="{{ route('flowcms::blog.show', $article->slug) }}" class="inline-block text-2xl md:text-3xl text-gray-800 hover:text-indigo-600 heading leading-tight font-normal mb-3 transition ease-out duration-300">
						{{ $article->title }}
					</a>

					<div class="text-sm md:text-base">{{ Str::limit(strip_tags($article->body), 200) }}</div>
				</div>

				<div class="mt-auto pt-2 pb-4 text-sm md:text-base">
					<x-flowcms-link to="{{ route('flowcms::blog.show', $article->slug) }}">Read more &rarr;</x-flowcms-link>
				</div>
			</div>

			@if($article->image)
				<div class="w-full md:w-1/3 order-first sm:order-last px-4">
					<div class="relative pb-48 bg-indigo-200 md:rounded-lg -mx-10 -mt-5 md:m-auto">
						<picture>
							<source media="(min-width: 500px)"
									srcset="{{ $article->images['medium'] }}" />
							<source media="(max-width: 500px)"
									srcset="{{ $article->images['small'] }}" />

							<img
								src="{{ $article->image }}"
								alt="Article Image"
								loading="lazy"
								class="z-10 md:rounded-lg shadow absolute inset-0 w-full h-full object-cover">
						</picture>
					</div>
				</div>
			@endif
		</x-flowcms-card>
	</div>
@empty
	<div class="px-4 py-10">
		No articles found.
	</div>
@endforelse
