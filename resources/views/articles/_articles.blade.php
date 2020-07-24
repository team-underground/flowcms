@forelse($articles as $article)
	<tr class="relative overflow-hidden"
		x-data="{
			showConfirm: false,
			deleteArticle(uuid) {
				return fetch(`/articles/${uuid}`, {
					method: 'POST',
					body: JSON.stringify({
						'_method': 'DELETE'
					}),
					headers: {
						'Content-Type': 'application/json',
						'Accept': 'application/json',
						'X-CSRF-TOKEN': '{{ csrf_token() }}'
					}
				})
				.then(response => response.json());
			}
		}"
		x-cloak>
		<td class="border-t border-gray-200 userId" :colspan="showConfirm === true ? 5 : 1">
			<div x-show="!showConfirm" class="relative text-gray-700 px-6 py-3 flex items-center">
				<div>
					<div class="font-semibold text-lg truncate">
						{{ $article->title }}
					</div>

					<div class="flex flex-wrap space-x-2 mt-1 text-sm">
						<a data-turbolinks-action="replace" class="text-gray-600 underline" href="{{ route('flowcms::articles.edit', $article->uuid) }}">Edit</a>
						<a target="_blank" class="text-gray-600 underline" href="{{ route('flowcms::blog.show', $article->slug) }}">Preview</a>
						<a class="underline text-red-500" href="#" x-on:click.prevent="showConfirm = true">Delete</a>
					</div>
				</div>
			</div>
			<div x-show="showConfirm" class="bg-gray-100 flex-1">
				<div class="flex items-center justify-between px-6 py-3">
					<div>
						<h3 class="font-semibold md:text-lg text-gray-700">Delete article: {{ $article->title }}?</h3>
						<p class="text-xs truncate">Are you sure you want to delete this article?</p>
					</div>
					<div class="flex items-center pt-1">
						<div>
							<x-flowcms-button type="button" x-on:click="showConfirm = false" class="bg-white text-gray-600 mr-2 shadow-sm">Cancel</x-flowcms-button>
						</div>

						<x-flowcms-button
							x-ref="deleteArticleButton"
							x-on:click="$refs.deleteArticleButton.classList.add('base-spinner', 'cursor-not-allowed'); deleteArticle('{{ $article->uuid }}').then(result => $dispatch('reload'));"
							type="button"
							class="bg-red-500 text-white shadow-sm">Delete</x-flowcms-button>
					</div>
				</div>
			</div>
		</td>
		<td x-show="!showConfirm" class="border-t border-gray-200">
			<span class="text-gray-700 px-6 py-3 flex items-center">
				{{ views($article)->unique()->count() ?? 0 }}
			</span>
		</td>
		<td x-show="!showConfirm" class="border-t border-gray-200">
			<span class="text-gray-700 px-6 py-3 flex items-center">
				{{ $article->category->name }}
			</span>
		</td>
		<td x-show="!showConfirm" class="border-t border-gray-200">
			<span class="text-gray-700 px-6 py-3 flex items-center">
				{{ $article->publish_date->format('d M, Y') }}
			</span>
		</td>
		<td x-show="!showConfirm" class="border-t border-gray-200">
			<span class="text-gray-700 px-6 py-3 flex items-center">
				@if ($article->article_status == 'Published')
					<x-flowcms-badge variant="success">{{ $article->article_status }}</x-flowcms-badge>
				@else
					<x-flowcms-badge>{{ $article->article_status }}</x-flowcms-badge>
				@endif
			</span>
		</td>
	</tr>
@empty
	<tr>
		<td colspan="5" class="px-6 py-10 text-center">No articles found.</td>
	</tr>
@endforelse
