@if(isset($type) && $type === 'submit')
	<button
		type="{{ $type }}" 
		name="{{ $name ?? '' }}"
		{{ $attributes->merge([
			'class' => 'transition duration-300 ease-out focus:outline-none focus:shadow-outline inline-flex px-4 py-2 rounded-lg border border-transparent font-medium'
		])}}>
		{{ $slot }}
	</button>
@else
	<button 
		type="button" 
		name="{{ $name ?? '' }}"
		{{ $attributes->merge([
			'class' => 'transition duration-300 ease-out focus:outline-none focus:shadow-outline inline-flex px-4 py-2 rounded-lg border border-transparent font-medium'
		])}}>
		{{ $slot }}
	</button>
@endif