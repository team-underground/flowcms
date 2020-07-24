<div
	@contact-modal.window="
		open = $event.detail.showContact
		body = $event.detail.body.trim();
		email = $event.detail.email;
		phone = $event.detail.phone;
		name = $event.detail.name;
	"
	x-data="{
		open: false,
		name: '',
		email: '',
		phone: '',
		body: ''
	}"
	x-cloak>
	{{-- Overlay --}}
	<div x-on:click="open = false" class="fixed inset-0 z-30 bg-gray-600 opacity-0 pointer-events-none transition-opacity ease-linear duration-300" :class="{'opacity-75 pointer-events-auto': open, 'opacity-0 pointer-events-none': !open}"></div>

		<div class="fixed inset-y-0 right-0 flex flex-col z-40 w-full md:max-w-md bg-white transform ease-in-out duration-300 translate-x-full" :class="{'translate-x-0': open, 'translate-x-full': !open}">

			<div class="h-full flex flex-col space-y-6 pt-6 bg-white overflow-y-scroll">
				<header class="px-4 sm:px-6 flex items-center justify-between">
					<h2 class="text-lg leading-7 font-semibold text-gray-900">
					Contact Details
					</h2>
					<button x-on:click="open = false" aria-label="Close panel" class="text-gray-600 hover:text-gray-400 transition ease-in-out duration-150">
						<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
						</svg>
					</button>
				</header>

				<div class="relative flex-1 h-0 px-4 sm:px-6 pb-6">
					<div>
						<div class="mb-4">
							<div class="mb-1 text-sm font-medium text-gray-800">Name</div>
							<div x-text="name"></div>
						</div>
						<div class="mb-4">
							<div class="mb-1 text-sm font-medium text-gray-800">Email</div>
							<div x-text="email"></div>
						</div>
						<div class="mb-4">
							<div class="mb-1 text-sm font-medium text-gray-800">Phone</div>
							<div x-text="phone || 'NA'"></div>
						</div>
						<div class="mb-4">
							<div class="mb-1 text-sm font-medium text-gray-800">Message</div>
							<div>
								<div x-html="body" class="whitespace-pre-wrap"></div>
							</div>
						</div>
					</div>

				</div>

				<div class="border-t px-4 sm:px-6 py-4 text-right">
					<button type="button" class="bg-white hover:bg-gray-100 text-gray-700 font-semibold py-2 px-4 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:shadow-outline" x-on:click="open = false">
						Close
					</button>
				</div>
			</div>

		</div>
	</div>
</div>


@forelse($contacts as $contact)
	<tr class="relative overflow-hidden"
		x-data="{
			showConfirm: false,
			deleteContact(uuid) {
				return fetch(`/contacts/${uuid}`, {
					method: 'POST',
					body: JSON.stringify({
						'_method': 'DELETE'
					}),
					headers: {
						'Content-Type': 'application/json',
						'Accept': 'application/json',
						'X-CSRF-TOKEN': '{{ csrf_token() }}'
					}
				})
				.then(response => response.json());
			}
		}"
		x-cloak>
		<td x-show="!showConfirm" class="border-t border-gray-200 w-1/5">
			<span class="text-gray-700 px-6 py-3 flex items-center">
				<div class="text-gray-700 font-semibold truncate">{{ $contact->name }}</div>
			</span>
		</td>
		<td x-show="!showConfirm" class="border-t border-gray-200">
			<span class="text-gray-700 px-6 py-3 flex items-center truncate">
				{{ Str::limit(strip_tags($contact->body), 80) }}
			</span>
		</td>
		<td class="border-t border-gray-200" :colspan="showConfirm === true ? 3 : 1">
			<div x-show="!showConfirm" class="relative text-gray-700 px-6 py-3 w-40">
				<div class="flex flex-wrap space-x-2 mt-1 text-sm">
				<a class="underline text-indigo-500" href="#" x-on:click.prevent="$dispatch('contact-modal', {
					showContact: true,
					name: '{{ $contact->name }}',
					email: '{{ $contact->email }}',
					phone: '{{ $contact->phone }}',
					body: `{{ $contact->body }}`
				})">Details</a>
					<a class="underline text-red-500" href="#" x-on:click.prevent="showConfirm = true">Delete</a>
				</div>
			</div>
			<div x-show="showConfirm" class="bg-gray-100 flex-1">
				<div class="flex items-center justify-between px-6 py-2">
					<div>
						<h3 class="font-semibold md:text-lg text-gray-700">Delete contact: {{ $contact->name }}?</h3>
						<p class="text-xs truncate">Are you sure you want to delete this contact?</p>
					</div>
					<div class="flex items-center pt-1">
						<div>
							<x-flowcms-button type="button" x-on:click="showConfirm = false" class="bg-white text-gray-600 mr-2 shadow-sm">Cancel</x-flowcms-button>
						</div>

						<x-flowcms-button
							x-ref="deleteContactButton"
							x-on:click="$refs.deleteContactButton.classList.add('base-spinner', 'cursor-not-allowed'); deleteContact('{{ $contact->uuid }}').then(result => $dispatch('reload')).then(() => $dispatch('notice', { type: 'success', text: 'Contact deleted'}));"
							type="button"
							class="bg-red-500 text-white shadow-sm">Delete</x-flowcms-button>
					</div>
				</div>
			</div>
		</td>
	</tr>
@empty
	<tr>
		<td colspan="3" class="px-6 py-10 text-center">No messages found.</td>
	</tr>
@endforelse
