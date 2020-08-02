<div class="flex flex-wrap -m-4">
	<x-flowcms-toastr />

	@forelse ($medias as $media)
		<div class="w-1/2 md:w-1/4 p-4">
			<div x-data="{
				confirm: false,
				copied: false,
				deleteImage(imagePath) {
					return fetch('/media/image/delete', {
						method: 'POST',
						body: JSON.stringify({
							path: imagePath
						}),
						headers: {
							'Content-Type': 'application/json',
							'Accept': 'application/json',
							'X-CSRF-TOKEN': '{{ csrf_token() }}'
						}
					})
					.then(response => response.json());
				},
				copyToClipboard(text) {
					const listener = function(ev) {
						ev.preventDefault();
						ev.clipboardData.setData('text/plain', text);
					};
					document.addEventListener('copy', listener);
					document.execCommand('copy');
					document.removeEventListener('copy', listener);
					this.copied = true;
					setTimeout(() => {
						this.copied = false
					}, 2500);
				}
			}" x-cloak class="relative rounded-lg">
		 
				<div class="mb-2 shadow-xs rounded-lg overflow-hidden p-2">
					<div class="relative pb-32 md:pb-40">
						@if ($media->type === 'svg')
							<img
								src="{{ $media->image_url }}"
								alt="{{ $media->name }}"
								class="w-full h-full object-fit inset-0 absolute"
								loading="lazy">
						@else
							
							@php
								$responsiveImages = responsive_image( $media->image_url );
							@endphp

							<picture>
								@if(count($responsiveImages))
									<source srcset="{{ $responsiveImages['small'] }}" />
								@endif
								<img
									src="{{ $media->image_url }}"
									alt="{{ $media->name }}"
									class="w-full h-full object-cover absolute inset-0"
									loading="lazy">
							</picture>
						@endif
					</div>
				</div>
				<h2 class="truncate font-medium text-sm tracking-tight text-gray-700 mb-1">{{ $media->name }}</h2>

				<div class="flex justify-between items-center">
					<div class="leading-tight">
						<p class="truncate text-xs text-gray-500">{{ $media->size }}</p>
						<p class="truncate text-xs text-gray-500 uppercase">{{ $media->type }}</p>
					</div>
					<div class="text-sm relative">
						<div x-show.transition="copied" class="-ml-16 mt-2 text-sm absolute top-0 left-0 text-green-500">Copied!</div>
						<button
							x-on:click="copyToClipboard('{{ $media->image_url }}'); $dispatch('notice', {type: 'success', text: 'URL copied'})"
							type="button" class="mr-1 focus:outline-none focus:shadow-outline shadow-xs p-2 rounded-lg hover:bg-gray-200 text-gray-500">
							<svg class="w-5 h-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
						</button>
						<button
							x-on:click="confirm = true"
							type="button" class="focus:outline-none shadow-xs p-2 rounded-lg hover:bg-gray-200 text-red-500">
							<svg class="w-5 h-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
						</button>
					</div>
				</div>

				<div x-show.transition="confirm" class="flex items-center justify-between absolute inset-0 bg-gray-100 rounded-lg shadow w-full h-full">
					<div class="flex-1 p-4">
						<h2 class="font-bold text-gray-800 mb-3 text-center">Delete this image?</h2>

						<div class="text-center">
							<x-flowcms-button x-on:click="deleteImage('{{ $media->path }}').then(data => $dispatch('reload')); $refs.deleteButton.classList.add('base-spinner', 'cursor-not-allowed');" x-ref="deleteButton" type="button" class="mb-2 mr-1 bg-red-500 text-white shadow w-full md:w-auto justify-center">Delete</x-flowcms-button>
							<x-flowcms-button x-on:click="confirm = false" type="button" class="bg-white text-gray-600 shadow w-full md:w-auto justify-center">Cancel</x-flowcms-button>
						</div>

					</div>
				</div>
			</div>
		</div>
	@empty
		<div class="w-full px-4 py-10 text-center">No images found.</div>
	@endforelse
</div>
