<div class="mb-5" x-data="{ content: '' }" x-init="
		quill = new Quill($refs.quillEditor, {
			modules: {
				{{-- syntax: true,    --}}
				toolbar: {
					container: [
					    [{'header': 2}, 'bold', 'italic', 'underline', 'strike'],
					    ['link', 'blockquote', 'code-block', 'image', 'video'],
						[{ list: 'ordered' }, { list: 'bullet' }],
						['clean']
					],
					handlers: {
						image: function () {
							var range = quill.getSelection();
							var value = prompt('Please enter your image URL');
							if(value){
								quill.insertEmbed(range.index, 'image', value, Quill.sources.USER);
							}
						}
					}
				}
			},
			theme: 'snow',
			placeholder: 'Write something great!'
		});
		quill.on('text-change', function () {
			content = quill.root.innerHTML;
		});
		quill.clipboard.addMatcher(Node.ELEMENT_NODE, function (node, delta) {
			var plaintext = node.innerText;
			var Delta = Quill.import('delta');
			return new Delta().insert(plaintext);
		});
		content = quill.root.innerHTML;
	">
	@if($label ?? null)
		<label for="{{ $name }}" class="form-label block mb-1 font-semibold text-gray-700">
			{{ $label }}
			@if($optional ?? null)
				<span class="text-sm text-gray-500 font-normal">(optional)</span>
			@endif
		</label>
	@endif

	<div class="relative">
		<input type="hidden" name="{{ $name }}" :value="content">
		<div x-ref="quillEditor" x-model="content" style="height: 500px" class="bg-white">
			{!! old($name, $value) !!}
		</div>
		
		@error($name)
			<div>
				<svg class="absolute text-red-600 fill-current w-5 h-5" style="top: 12px; right: 12px"
					xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
					<path
						d="M11.953,2C6.465,2,2,6.486,2,12s4.486,10,10,10s10-4.486,10-10S17.493,2,11.953,2z M13,17h-2v-2h2V17z M13,13h-2V7h2V13z" />
				</svg>
				<div class="text-red-600 mt-2 text-sm block leading-tight">{{ $message }}</div>
			</div>
		@enderror
	</div>
</div>