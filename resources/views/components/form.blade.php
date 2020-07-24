@props([
	'method' => 'POST',
	'action'
])
 
<form 
	action="{{ $action }}" 
	method="{{ $method === 'GET' ? 'GET' : 'POST' }}"
	{{ $attributes }}
	onsubmit="event.submitter.disabled = true; event.submitter.classList.add('base-spinner')">
	@csrf

	@if (!in_array($method, ['GET', 'POST']))
		@method($method)
	@endif

	{{ $slot }}
</form>