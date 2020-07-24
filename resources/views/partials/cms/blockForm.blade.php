<x-flowcms-form action="{{ $update }}" method="PUT">
	<input type="hidden" name="type" value="{{ $block->type }}">

	@php $fields = collect(config('cms.blocks.'. $block->type ))->all(); @endphp
	@foreach($fields as $field)
		@if($field['type'] == config('cms.constants.TEXT'))
			@if($field['field'] === 'icon')
				@php
					$defaultIcon = $block->value[$field['field']];
				@endphp
				<div x-data="{ 'icon{{ $block->id }}': '' }"
					x-init="icon{{ $block->id }} = '{{ $defaultIcon }}'">

					<x-flowcms-text-input
						x-model="{{ $field['field'] }}{{ $block->id }}"
						name="{{ $field['field'] }}-{{ $block->id }}"
						placeholder="{{ $field['field'] }}"
						value="{{ $block->value[$field['field']] }}" />

					<div class="flex flex-wrap -mx-2 mb-4">
						@foreach ($icons as $icon)
							@php
								$iconPath = $icon['path'];
								$currentIcon = 'icon' . $block->id;
							@endphp
							<div class="px-2 md:w-2/12">
								<div
									class="my-2 w-full rounded-lg shadow cursor-pointer"
									:class="{'bg-indigo-600 text-white': '{{ $iconPath }}' ===  {{ $currentIcon }}, 'bg-white text-indigo-500':  '{{ $currentIcon }}' == '' }"
									x-on:click="icon{{ $block->id }} = '{{ $iconPath }}'">
									<div class="h-10 w-10 p-2 mx-auto">
										@svg($icon['fullpath'])
									</div>
								</div>
							</div>
						@endforeach
					</div>
				</div>
			@else
				<x-flowcms-text-input
					name="{{ $field['field'] }}-{{ $block->id }}"
					placeholder="{{ $field['field'] }}"
					value="{{ $block->value[$field['field']] }}" />
			@endif
		@endif

		@if($field['type'] == config('cms.constants.CHECKBOX'))
			<x-flowcms-checkbox
				name="{{ $field['field'] }}-{{ $block->id }}"
				value="{{ $field['value'] }}"
				selected-value="{{ $block->value[$field['field']] ?? '' }}"
				>{{ $field['field'] }}</x-flowcms-checkbox>
		@endif

		@if($field['type'] == config('cms.constants.TEXTAREA'))
			<x-flowcms-textarea-input
				name="{{ $field['field'] }}-{{ $block->id }}"
				placeholder="{{ $field['field'] }}"
				value="{{ $block->value[$field['field']] }}" />
		@endif

	@endforeach

	<div class="flex space-x-2">
		<x-flowcms-button type="submit" class="bg-gray-700 hover:bg-gray-800 text-white">Update</x-flowcms-button>

		<x-flowcms-button
			class="bg-gray-200 hover:bg-gray-100 text-red-600"
			onclick="if (confirm('Are you sure?')) {
				document.getElementById('js-{{ $block->type }}-delete-{{ $block->id }}').submit();
			}">Delete</x-flowcms-button>
	</div>
</x-flowcms-form>

<x-flowcms-form action="{{ $delete }}" method="DELETE" id="js-{{ $block->type }}-delete-{{ $block->id }}"></x-flowcms-form>
