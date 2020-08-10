@if ($paginator->hasPages())
    <div class="flex md:flex-row-reverse items-center justify-between w-full px-4">
        <div class="flex items-center">

            <div class="mr-1">
                @if ($paginator->onFirstPage())
                    <span class="cursor-not-allowed opacity-50 py-2 px-3 text-gray-800 font-medium inline-flex items-center border border-transparent hover:border-gray-300 leading-none rounded-lg"
                    >
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>Previous
                    </span>
                @else
                    <button
                        x-on:click="$dispatch('goto-page', { page: '{{ $paginator->previousPageUrl() }}' })"
                        class="py-2 px-3 leading-none rounded-lg text-gray-700 font-medium inline-flex items-center border border-transparent hover:border-gray-300"
                    >
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>Previous
                    </button>
                @endif
            </div>

            <div class="hidden md:block">
                @foreach ($elements as $element)

                    @if (is_string($element))
                        <span class="-mt-1 inline border border-transparent px-4 py-3 no-underline inline-flex items-center cursor-not-allowed no-underline">{{ $element }}</span>
                    @endif


                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <div class="border border-transparent text-white bg-indigo-500 inline px-3 py-2 rounded-lg leading-none  no-underline inline-flex items-center">{{ $page }}</div>
                            @else
                                <button
                                    x-on:click="$dispatch('goto-page', {page: '{{ $paginator->url($page) }}'})"
                                    class="cursor-pointer text-gray-700 hover:text-indigo-500 border border-transparent hover:border-gray-300 px-3 py-2 rounded-lg leading-none no-underline inline-flex items-center">{{ $page }}
                                </button>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </div>

            <div class="ml-1">
                @if ($paginator->hasMorePages())
                    <button 
                        x-on:click="$dispatch('goto-page', { page: '{{ $paginator->nextPageUrl() }}'  })" 
                        class="py-2 px-3 leading-none text-gray-700 font-medium inline-flex items-center border border-transparent hover:border-gray-300 rounded-lg">
                        Next<svg class="h-6 w-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                @else
                    <span class="py-2 px-3 leading-none text-gray-700 font-medium inline-flex items-center border border-transparent hover:border-gray-300 rounded-lg cursor-not-allowed opacity-50">
                        Next<svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                        </svg>
                    </span>
                @endif
            </div>
        </div>
        <div class="flex-1">
            <div class="text-gray-600 text-sm ml-5 md:ml-0 truncate">
                Showing {{ $paginator->firstItem() }} to {{ $paginator->lastItem() }}  of {{ $paginator->total() }} results
            </div>
        </div>
    </div>
@endif