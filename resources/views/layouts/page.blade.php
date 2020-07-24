@extends('flowcms::layouts.pagemaster')

@section('page-content')
	@if ($page->layout == '')
		<x-flowcms-section-centered>
			{{-- Show this for logged in user --}}
			@if($page->blocks->isNotEmpty())
				<x-flowcms-alert :close="false">
					<strong>Note:</strong> You need to update the order for the blocks to appear.
				</x-flowcms-alert>
			@endif

			{{-- <div class="flex flex-wrap -m-4">
				@if($page->blocks->isNotEmpty())
					@foreach ($page->blocks as $pageblock)
						@if($pageblock->type === 'services')
							@include('partials.cms.front.blocks.services')
						@endif
					@endforeach
				@endif
			</div> --}}
		</x-flowcms-section-centered>

		{{-- <x-flowcms-section-centered>
			<div class="flex flex-wrap -m-4">
				@if($page->blocks->isNotEmpty())
					@foreach ($page->blocks as $pageblock)
						@if ($pageblock->type === 'cta')
							@include('partials.cms.front.blocks.cta')
						@endif
					@endforeach
				@endif
			</div>
		</x-flowcms-section-centered> --}}
		@else
		@foreach(explode(',', $page->layout) as $index => $serviceName)
			@if($page->blocks->isNotEmpty())
				<x-flowcms-section-centered>
					<div class="flex flex-wrap -mx-4">
						@foreach ($page->blocks as $pageblock)
							@if($pageblock->type === $serviceName)
								@include('flowcms::partials.cms.front.blocks.'. $serviceName, [
									'count' => count($page->blocks) ?? 0
								])
							@endif
						@endforeach
					</div>
				</x-flowcms-section-centered>
			@endif
		@endforeach
	@endif
@endsection
