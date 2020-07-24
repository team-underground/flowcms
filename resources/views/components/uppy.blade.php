@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/uppy/1.16.1/uppy.min.css" rel="stylesheet" data-turbolinks-track="reload">
@endpush


@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/uppy/1.16.1/uppy.min.js" data-turbolinks-track="reload"></script>
@endpush

<div
	x-data 
	x-init="
		uppy = Uppy.Core({
				autoProceed: true,
				allowMultipleUploads: true,
				debug: false,
				maxFileSize: 1*1024*1024,
				minNumberOfFiles: 1,
				maxNumberOfFiles: 3,
				allowedFileTypes: ['image/*', 'image/svg+xml'],
				onBeforeFileAdded: function(file) {
					if (! ['image/jpeg', 'image/png', 'image/jpg', 'image/svg+xml'].includes(file.type)) {
						{{-- console.log(file.type); --}}
						$dispatch('notice', { type: 'error', text: 'Image format invalid: jpg/png only'});
						return false;
					}
				}
			}).use(Uppy.Dashboard, {
				hideUploadButton: true,
				height: 320,
				width: '100%',
				inline: true,
				target: $refs.dropzone,
				replaceTargetContent: true,
				showProgressDetails: true,
				browserBackButtonClose: true,
				note: 'Images only, 2–3 files, up to 1 MB',
			}).use(Uppy.XHRUpload, {
				endpoint: '{{ $endpoint }}',
				formData: true,
                fieldName: 'file',
				headers: {
					'X-CSRF-TOKEN': '{{ csrf_token() }}',
					'Accept': 'Application/JSON'
				}
			});

		uppy.on('complete', (result) => {
			{{-- console.log('Upload complete! We’ve uploaded these files:', result.successful)
			console.log(result); --}}
			{{-- console.log('failed files:', result.failed); --}}
			$dispatch('reload');

			setTimeout(() => {
				uppy.reset();
			}, 2500)
		})  
	">
	<div id="{{ $id ?? 'drag-drop-area' }}" x-ref="dropzone"></div>
</div>