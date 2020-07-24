<x-flowcms-select-input id="{{ $field['name'] }}" name="{{ $field['name'] }}" label="{{ $field['label'] }}">
	@foreach($field['options'] as $option)
		<option value="{{ $option }}" {{ setting($field['name']) === $option ? 'selected' : '' }}>{{ $option }}</option>
	@endforeach
</x-flowcms-select-input>
