<div class="w-full p-4">
	<div class="md:max-w-4xl md:mx-auto text-center">
		<div class="text-gray-600 mb-1">@nl2br($pageblock->value['content'])</div>
		<h3 class="mb-6 heading leading-tight text-gray-800 text-3xl sm:text-4xl">{{ $pageblock->value['title'] }}</h3>
		<a
			href="{{ $pageblock->value['link_url'] }}" 
			class="px-5 py-4 inline-flex items-center justify-center font-medium rounded-lg bg-gray-700 hover:bg-gray-800 text-white mb-4 truncate transition duration-300 ease-in-out">
			{{ $pageblock->value['link_text'] }}
		</a>
	</div>
</div>