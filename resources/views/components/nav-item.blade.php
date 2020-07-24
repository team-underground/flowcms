@php
	$navlinkActive = \Illuminate\Support\Str::startsWith(request()->url(), $to) ? 'bg-gray-200 text-gray-800' : 'text-gray-700';
@endphp

<a 
	href="{{ $to }}" 
	{{ $attributes->merge([
		'class' => 'mb-1 rounded-lg px-4 py-1 block hover:bg-gray-200 transition duration-200 ease-out '. $navlinkActive
	])}}>
	{{ $slot }}
</a>