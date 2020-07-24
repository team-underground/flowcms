<x-flowcms-textarea-input
	id="{{ $field['name'] }}"
	label="{{ $field['label'] }}"
	name="{{ $field['name'] }}"
	hint="{{ $field['hint'] ?? '' }}"
	placeholder="{{ $field['placeholder'] }}"
	value="{!! setting($field['name']) !!}" />
