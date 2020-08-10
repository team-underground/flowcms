<a href="{{ $to }}"
	{{ $attributes->merge([
		'class' => 'text-indigo-500 underline underline-indigo-200 hover:text-indigo-600 transition duration-300 ease-out inline-flex items-center'
	])}}
	>
	{{ $slot }}
</a>