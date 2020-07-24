<a href="{{ $to }}"
	{{ $attributes->merge([
		'class' => 'text-indigo-500 border-b border-indigo-200 hover:text-indigo-700 transition duration-300 ease-out'
	])}}
	>
	{{ $slot }}
</a>