@php 
	if ($count == 2 || $count == 4) {
		$gridClass = 'md:w-1/2';
	} else {
		$gridClass = 'md:w-1/3';
	}
@endphp

<div class="w-full p-4 {{ $gridClass }}" data-aos="fade-right">
	<div class="flex rounded-lg h-full pr-6 flex-col">
		@if($pageblock->value['icon']) 
			<div class="w-10 h-10 mb-5 inline-flex items-center justify-center rounded-full bg-indigo-600 text-white flex-shrink-0">
				<div class="w-6 h-6">
					@if(isFileSvg($pageblock->value['icon']))
						@svg(url($pageblock->value['icon']))
					@else
						<span class="heading">{{ $pageblock->value['icon'] }}</span>
					@endif
				</div>
			</div>
		@endif

		<h2 class="mb-2 text-gray-900 text-lg title-font font-semibold leading-tight">{!! $pageblock->value['title'] !!}</h2>
		<p class="leading-relaxed text-base text-gray-600 email-links">{{ $pageblock->value['content'] }}</p>	 
	</div>
</div>