
@php
$fields = collect($pageblock->value)->keys();
$contactfields = collect(config('cms.blocks.contact_us'));
@endphp

<div class="flex flex-wrap items-center flex-1" id="contact">
	<div class="w-full md:max-w-3xl md:mx-auto px-4">
		{{-- @if($pageblock->value['title'])
			<h2 class="text-center text-lg mb-2">{{ $pageblock->value['title'] }}</h2>
		@endif --}}

		@include('flowcms::partials.flash')

		<x-flowcms-form action="{{ route('flowcms::contact.store') }}#contact" method="POST">
			@honeypot

			@foreach($contactfields as $field)

				@if($field['field'] != 'body' && $field['field'] != 'title')
					@if($fields->contains($field['field']))
						<x-flowcms-text-input type="text" name="{{ $field['field'] }}" label="{{ Str::studly($field['field']) }}" />
					@endif
				@endif

				@if($field['field'] === 'body')
					@if($fields->contains($field['field']))
						<x-flowcms-textarea-input name="{{ $field['field'] }}" label="{{ Str::studly($field['field']) }}" />
					@endif
				@endif

			@endforeach

			<x-flowcms-button type="submit" class="mt-2 w-full md:w-auto justify-center bg-gray-700 hover:bg-gray-800 text-white">Send Message</x-flowcms-button>
		</x-flowcms-form>
	</div>
</div>

