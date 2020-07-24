<div class="w-full p-4">
	<div class="flex flex-col md:flex-row rounded-lg bg-white p-8 md:items-center md:justify-between overflow-hidden relative">
		<div class="hidden md:block">
			<div class="-ml-16">
				<div class="w-16 h-16 bg-indigo-500 rounded-full -mb-5"></div>
				<div class="w-24 h-24 bg-gray-700 rounded-full"></div>
			</div>
		</div>
		<div class="md:pr-8">
			<h3 class="heading mb-1 leading-tight text-gray-800 text-3xl sm:text-4xl">{{ $pageblock->value['title'] }}</h3>
			<div class="text-gray-600 md:max-w-xl">@nl2br($pageblock->value['content'])</div>
		</div>
		<div class="md:w-48 mt-8 md:mt-0">
			<a
				href="{{ $pageblock->value['link_url'] }}" 
				class="px-5 py-4 inline-flex items-center justify-center font-medium rounded-lg bg-gray-700 hover:bg-gray-800 text-white mb-4 truncate transition duration-300 ease-in-out">
				{{ $pageblock->value['link_text'] }}
			</a>
		</div>

		<div class="mr-4 absolute right-0 bottom-0 mb-4 md:hidden">
			<div class="grid-dotted h-24 w-32 text-gray-400"></div>
		</div>
	</div>
</div>