<div class="flex flex-wrap items-center flex-1 md:py-6">
	<div class="w-full md:w-1/2 px-4">
		<h1 class="heading text-3xl md:text-5xl text-gray-800 leading-none mb-4">
			<span class="block md:inline">{{ $pageblock->value['title'] }}</span>
		</h1>
	
		<p class="md:text-lg">{{ $pageblock->value['content'] }}</p>
		
		@if($pageblock->value['link_url'])
			<div class="flex space-x-4 mt-6">
				<a href="{{ $pageblock->value['link_url'] }}" class="font-medium inline-flex rounded-lg px-5 py-3 bg-gray-700 hover:bg-gray-800 text-white">{{ $pageblock->value['link_text'] }}</a>
			</div>
		@endif
	</div>
	<div class="w-full md:w-1/2 px-4 mt-10 md:mt-0">
		<div class="relative" style="padding-bottom: 75%">
			<div class="grid-dotted h-24 text-gray-400 w-32 absolute top-0 right-0 -mt-12"></div>
			<div class="grid-dotted h-24 text-gray-400 w-32 absolute bottom-0 left-0 -mb-12"></div>
			{{-- <img 
				src="{{ $pageblock->value['image_url'] }}" 
				alt="hero image" 
				class="absolute w-full h-full object-cover"> --}}

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
						class="absolute w-full h-full object-cover">
				</picture>
		</div>
	</div>
</div>