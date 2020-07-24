@if($links)
	<div class="flex flex-wrap space-x-2 items-center">
		@foreach($links as $key => $value)
			@if($key !== 'Current')
				<a 
					href="{{ $value }}" 
					class="text-gray-400 hover:text-gray-100 hover:underline">{{ \Illuminate\Support\Str::title($key) }}</a>
			@endif
			 
			@if($loop->last && $key === 'Current') 
				<span class="text-indigo-500 truncate">{{ $value }}</span>
			@endif

			@if(!$loop->last) 
				<span class="text-gray-400 w-4 h-4">@svg(url('/cms/icons/chevron-right.svg'))</span>
			@endif
		@endforeach
	</div>
@endif