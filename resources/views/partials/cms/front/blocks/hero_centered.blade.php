<div class="flex flex-1 flex-col justify-between md:py-6">
	<div class="w-full md:max-w-4xl md:mx-auto text-center px-4" data-aos="fade-down">
		<h1 class="heading text-3xl md:text-5xl text-gray-800 leading-tight mb-5">
			{{ $pageblock->value['title'] }}
		</h1>
	
		<p class="w-full md:max-w-2xl md:mx-auto md:text-lg">{{ $pageblock->value['content'] }}</p>
		
		@if($pageblock->value['link_url'])
			<div class="mt-8">
				<a href="{{ $pageblock->value['link_url'] }}" class="font-medium inline-flex rounded-lg px-6 py-4 bg-indigo-700 hover:bg-indigo-800 text-white shadow-sm transition ease-in-out duration-300">{{ $pageblock->value['link_text'] }}</a>
			</div>
		@endif
	</div>
	 
	<div class="relative w-full mt-16" data-aos="fade-up">
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
					class="object-fit mx-auto relative">
			</picture>
	</div>
</div>