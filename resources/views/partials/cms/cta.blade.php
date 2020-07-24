<x-flowcms-form action="{{ $update }}" method="PUT">
	<input type="hidden" name="type" value="{{ $block->type }}">

	@php $fields = collect(config('cms.blocks.cta'))->all(); @endphp
	@foreach($fields as $field)
		@if($field['type'] == config('cms.constants.TEXT'))
			<div class="mb-5">
				<x-flowcms-text-input
					name="{{ $field['field'] }}-{{ $block->id }}"
					placeholder="{{ $field['field'] }}"
					value="{{ $block->value[$field['field']] }}" />
			</div>
		@endif

		@if($field['type'] == config('cms.constants.TEXTAREA'))
			<x-flowcms-textarea-input
				name="{{ $field['field'] }}-{{ $block->id }}"
				placeholder="{{ $field['field'] }}"
				value="{{ $block->value[$field['field']] }}" />
		@endif
	@endforeach

	<div class="flex space-x-2">
		<x-flowcms-button type="submit" class="bg-gray-700 hover:bg-gray-800 text-white">Update Block</x-flowcms-button>
		<x-flowcms-button
			class="bg-gray-200 hover:bg-gray-100 text-red-600"
			onclick="if (confirm('Are you sure?')) {
				document.getElementById('js-{{ $block->type }}-delete-{{ $block->id }}').submit();
			}">Delete</x-flowcms-button>
	</div>
</x-flowcms-form>

<x-flowcms-form action="{{ $delete }}" method="DELETE" id="js-{{ $block->type }}-delete-{{ $block->id }}"></x-flowcms-form>
