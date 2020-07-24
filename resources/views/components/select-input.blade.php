<div class="mb-5">
    @if($label ?? null)
		<label for="{{ $name }}" class="form-label block mb-1 font-semibold text-gray-700">
			{{ $label }}
		</label>
    @endif

    <div class="relative">
		<select
			name="{{ $name }}"
			id="{{ $id ?? $name }}"
			class="form-input form-select transition px-3 py-2 block w-full text-gray-600 bg-white font-sans rounded-lg text-left appearance-none focus:outline-none bg-white shadow-sm border {{ $errors->has($name) ? ' border-red-500 bg-red-100' : ' border-gray-300' }}"
		>
			{{ $slot }}
		</select>

        <svg class="absolute top-0 right-0 mt-2 mr-3 w-6 h-6 text-gray-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path></svg>

        <div>
			@error($name)
				<svg class="absolute text-red-600 fill-current w-5 h-5" style="top: 12px; right: 12px"
					xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
					<path
						d="M11.953,2C6.465,2,2,6.486,2,12s4.486,10,10,10s10-4.486,10-10S17.493,2,11.953,2z M13,17h-2v-2h2V17z M13,13h-2V7h2V13z" />
				</svg>
				<div class="text-red-600 mt-2 text-sm block leading-tight">{{ $message }}</div>
			@enderror
		</div>
    </div>
</div>
