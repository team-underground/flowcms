<div class="mb-5">
    @if($label ?? null)
		<label for="{{ $name }}" class="form-label block mb-1 font-semibold text-gray-700">
			{{ $label }}
			@if($optional ?? null)
				<span class="text-sm text-gray-500 font-normal">(optional)</span>
			@endif
		</label>
    @endif

    <div class="relative">
        <input
			id="{{ $name . Str::random(8) }}"
			autocomplete="off"
        	type="{{ $type ?? 'text' }}"
            class="form-input transition px-3 py-2 block w-full text-gray-800 bg-white font-sans rounded-lg text-left appearance-none focus:outline-none focus:shadow-outline bg-white shadow-sm border {{ $errors->has($name) ? ' border-red-500 bg-red-100' : ' border-gray-300' }}"
            name="{{ $name }}"
			placeholder="{{ $placeholder ?? '' }}"
            value="{{ old($name, $value ?? '') }}"
			{{ ($required ?? false) ? 'required' : '' }}
			{{ $attributes }}
		>

		@isset($hint)
			<div class="text-sm text-gray-500 my-2 leading-tight help-text">{{ $hint }}</div>
		@endisset


		@error($name)
			<svg class="absolute text-red-600 fill-current w-5 h-5" style="top: 12px; right: 12px"
				xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
				<path
					d="M11.953,2C6.465,2,2,6.486,2,12s4.486,10,10,10s10-4.486,10-10S17.493,2,11.953,2z M13,17h-2v-2h2V17z M13,13h-2V7h2V13z" />
			</svg>
			<div class="text-red-600 mt-2 text-sm block leading-tight error-text">{{ $message }}</div>
		@enderror
    </div>
</div>
