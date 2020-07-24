@props(['to', 'variant' => 'default'])

@php
$navlinkClass = [
	'dark' => request()->is($to) ? 'hover:text-gray-100 border-gray-200 text-gray-100' : 'hover:text-gray-100 border-transparent text-gray-500',
	'default' => request()->is($to) ? 'hover:text-gray-800 border-gray-500 text-gray-800' : 'hover:text-gray-800 border-transparent text-gray-600'
];
@endphp

<a
	{{ $attributes->merge([
		'class' => "transition duration-300 ease-out inline-flex py-5 border-b font-medium ". $navlinkClass[$variant]
	]) }}
	href="{{ url($to) }}">
	{{ $slot }}
</a>