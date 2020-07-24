<div class="flex flex-wrap items-center flex-1 md:py-10">
	<div class="w-full md:w-1/2 px-4 mt-10 md:mt-0">
		{{-- <div class="relative">
			<div class="grid-dotted h-24 text-gray-400 w-32 absolute top-0 right-0 -mt-12"></div>
			<div class="grid-dotted h-24 text-gray-400 w-32 absolute bottom-0 left-0 -mb-12"></div>
			<img src="{{ $pageblock->value['image_url'] }}" alt="" class="relative w-full h-auto object-fit">
		</div> --}}
		<div class="relative" style="padding-bottom: 70%">
			<div class="grid-dotted h-24 text-gray-400 w-32 absolute top-0 right-0 -mt-12"></div>
			<div class="grid-dotted h-24 text-gray-400 w-32 absolute bottom-0 left-0 -mb-12"></div>
	
			@php 
				$responsiveImages = responsive_image($pageblock->value['image_url']);
			@endphp

			<picture>
				@if(count($responsiveImages))
					<source media="(min-width: 750px)"
							srcset="{{ $responsiveImages['large'] }}" />
					<source media="(min-width: 500px)"
							srcset="{{ $responsiveImages['medium'] }}" />
					<source media="(max-width: 500px)"
							srcset="{{ $responsiveImages['small'] }}" />
				@endif
				<img
					src="{{ $pageblock->value['image_url'] }}"
					alt="Article Image" 
					loading="lazy" 
					class="absolute w-full h-full object-fit z-10">
			</picture>
		</div>
	</div>
	<div class="w-full md:w-1/2 px-4">
		<div class="md:px-10 mt-16 md:mt-0 text-center md:text-left" data-aos="fade-left">
			<h2 class="heading text-3xl md:text-5xl text-gray-800 leading-tight mb-4">
				{{ $pageblock->value['title'] }}
			</h2>
		
			<p>{{ $pageblock->value['content'] }}</p>
			
			@isset($pageblock->value['link_url'])
				<div class="flex space-x-4 mt-6">
					<a href="{{ $pageblock->value['link_url'] }}" class="font-medium inline-flex rounded-lg px-6 py-3 bg-indigo-700 hover:bg-indigo-800 text-white duration-300 ease-in-out">{{ $pageblock->value['link_text'] }}</a>
				</div>
			@endisset
		</div>
	</div>
</div>