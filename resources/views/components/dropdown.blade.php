@props(['alignment' => 'left'])

@php
    $alignmentClasses = [
        'left' => 'left-0',
        'right' => 'right-0',
    ];   
@endphp

<div x-data="{ open: false }" class="relative" x-cloak>
    <div x-on:click="open = ! open" class="cursor-pointer">
		{{ $trigger }}
	</div>

    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform scale-95"
        x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-95"
		@click.away="open = false"
		class="absolute {{ $alignmentClasses[$alignment] }} w-40 z-20 shadow-xs shadow-lg overflow-hidden rounded-lg p-1 bg-white mt-2 -mr-1"
    >   
        {{ $slot }}
    </div>
</div>