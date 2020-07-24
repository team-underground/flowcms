@props(['variant' => 'info'])

@php
$badgeClass = [
	'info' => 'bg-blue-200 text-blue-700',
	'success' => 'bg-green-200 text-green-800',
	'warning' => 'bg-orange-200 text-orange-800',
	'danger' => 'bg-red-200 text-red-800'
];	
@endphp

<span {{ $attributes->merge(['class' => 'px-2 rounded-full uppercase text-sm tracking-wide font-semibold '. $badgeClass[$variant]]) }}>
	{{ $slot }}
</span>