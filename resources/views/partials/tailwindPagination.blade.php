@if ($paginator->hasPages())
    <div class="flex justify-between w-full border-t-2 border-gray-300">

		{{-- Previous Page Link --}}
		<div>
			@if ($paginator->onFirstPage())
				<span class="cursor-not-allowed opacity-50 py-3 text-gray-800 font-semibold inline-flex items-center border-t-2 border-transparent"
				>
					<svg class="h-6 w-6" fill="currentColor" viewBox="0 0 20 20">
						<path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/>
					</svg>Previous
				</span>
			@else
				<a
					href="{{ $paginator->previousPageUrl() }}" class="py-3 text-gray-800 font-semibold inline-flex items-center border-t-2 border-transparent"
				>
					<svg class="h-6 w-6" fill="currentColor" viewBox="0 0 20 20">
						<path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/>
					</svg>Previous
				</a>
			@endif
		</div>

		{{-- Pagination Elements --}}
        <div class="hidden md:block">
			@foreach ($elements as $element)
				{{-- "Three Dots" Separator --}}
				@if (is_string($element))
					<span class="-mt-1 inline border-t-2 border-transparent px-4 py-3 no-underline inline-flex items-center cursor-not-allowed no-underline">{{ $element }}</span>
				@endif
				
				{{-- Array Of Links --}}
            	@if (is_array($element))
                	@foreach ($element as $page => $url)
						@if ($page == $paginator->currentPage())
							<span class="text-indigo-500 border-indigo-500 -mt-px inline border-t-2 border-transparent px-4 py-3 no-underline inline-flex items-center">{{ $page }}</span>
						@else
							<a href="{{ $url }}" class="text-gray-700 hover:text-indigo-500 -mt-px inline border-t-2 border-transparent px-4 py-3 no-underline inline-flex items-center">{{ $page }}</a>
						@endif
					@endforeach
            	@endif
			@endforeach
		</div>

		{{-- Next Page Link --}}
		<div>
			@if ($paginator->hasMorePages())
				<a href="{{ $paginator->nextPageUrl() }}" class="py-3 text-gray-800 font-semibold inline-flex items-center border-t-2 border-transparent">
					Next<svg class="h-6 w-6" fill="currentColor" viewBox="0 0 20 20">
						<path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
					</svg>
				</a>
			@else
				<span class="py-3 text-gray-800 font-semibold inline-flex items-center border-t-2 border-transparent cursor-not-allowed opacity-50">
					Next<svg class="h-6 w-6" fill="currentColor" viewBox="0 0 20 20">
						<path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
					</svg>
				</span>
			@endif
		</div>
    </div>
@endif