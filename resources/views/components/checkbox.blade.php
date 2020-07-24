<label
	class="md:w-1/2 flex flex-1 justify-start items-center text-truncate hover:bg-gray-100 px-2 py-2">
	<div class="text-gray-800 mr-2">
		<input 
			id="{{ Str::random(8) }}"
			type="checkbox" 
			class="form-checkbox focus:outline-none focus:shadow-outline" 
			name="{{ $name }}"
			{{ !empty($selectedValue) && $selectedValue === $value ? 'checked' : '' }}
			value="{{ old($name, $value ?? '') }}"
			{{ $attributes }}>
	</div>
	<div class="select-none text-gray-700">
		 {{ $slot }}
	</div>
</label>