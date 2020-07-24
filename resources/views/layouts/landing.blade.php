@extends('flowcms::layouts.front')

@push('styles')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" data-turbolinks-track="true">
@endpush

@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js" data-turbolinks-track="true"></script>
<script>
	document.addEventListener('turbolinks:load', () => {
		AOS.init();
	});
</script>
@endpush

@section('content')
	<div class="bg-transparent">
		<div class="md:max-w-6xl md:mx-auto pt-2 px-4">
			@include('flowcms::partials.cms.admin.navbarInverse')
		</div>
	</div>

	<div id="js-content">
		{{-- Page Blocks --}}
		@foreach($layouts as $index => $service)
			@php
				$serviceName = explode('-', $service)[0];
				$pageID = explode('-', $service)[1];
			@endphp

			{{-- {{ $blocks }} --}}

			<div class="md:py-10 {{ $loop->iteration % 2 == 0 ? 'bg-white' : 'bg-gray-200' }}">

				@if($blocks->isNotEmpty())

					@if(! Str::contains($blocks[$serviceName][0]->type, ['cta', 'testimonial', 'hero']))
						<x-flowcms-section-centered>
							<div class="md:max-w-3xl md:mx-auto text-center">
								@if($blocks[$serviceName][0]->page->display_title)
								<h2 class="heading text-gray-800 text-3xl sm:text-5xl">{{ $blocks[$serviceName][0]->page->display_title }}</h2>
								@endif

								@if($blocks[$serviceName][0]->page->body)
									<div class="mt-3 main-content text-gray-600 email-links">@nl2br($blocks[$serviceName][0]->page->body)</div>
								@endif
							</div>
						</x-flowcms-section-centered>
					@endif

					<x-flowcms-section-centered>
						<div class="flex flex-wrap -mx-4">
							@foreach ($blocks[$serviceName] as $pageblock)
								@if($pageblock->type === $serviceName && $pageblock->page_id === (int) $pageID)
									@include('flowcms::partials.cms.front.blocks.'. $serviceName, [
										'count' => count($blocks[$serviceName]) ?? 0
									])
								@endif
							@endforeach
						</div>
					</x-flowcms-section-centered>

				@endif

			</div>
		@endforeach
		{{-- ./ Page Blocks --}}
	</div>
@endsection
