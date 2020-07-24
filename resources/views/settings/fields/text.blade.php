<x-flowcms-text-input
	id="{{ $field['name'] }}"
	label="{{ $field['label'] }}"
	type="{{ $field['type'] }}"
	name="{{ $field['name'] }}"
	hint="{{ $field['hint'] ?? '' }}"
	placeholder="{{ $field['placeholder'] }}"
	value="{{ setting($field['name']) }}" />
