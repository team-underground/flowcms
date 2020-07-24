@php
	$navlinkActive = \Illuminate\Support\Str::startsWith(request()->url(), $to) ? 'bg-indigo-100 text-indigo-600' : 'text-gray-700';
@endphp

<a 
	href="{{ $to }}" 
	{{ $attributes->merge([
		'class' => 'truncate mb-1 rounded-lg px-4 py-1 block hover:bg-indigo-100 transition duration-200 ease-out '. $navlinkActive
	])}}>
	{{ $slot }}
</a>