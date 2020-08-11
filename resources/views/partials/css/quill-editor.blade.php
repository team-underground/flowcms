@push('styles')
<link href="https://unpkg.com/quill@latest/dist/quill.snow.css" rel="stylesheet" data-turbolinks-track="reload" />
<style>
.ql-editor-haserror .ql-toolbar.ql-snow + .ql-container.ql-snow {
	border: 1px solid #f56565;
	border-radius: 0.5rem;
}
.ql-toolbar.ql-snow + .ql-container.ql-snow {
    border: 1px solid #e2e8f0; 
    border-radius: 0.5rem;
}
.ql-toolbar.ql-snow {
    font-family: inherit;
	border-top-left-radius: 0.5rem;
  	border-top-right-radius: 0.5rem;
	background-color: #fff;
	border: none;
	box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
	position: sticky;
	top: 0;
	z-index: 1;
	margin-left: 1px;
	margin-right: 1px;
}
.ql-container {
	color: #2d3748;
	font-family: inherit;
	font-size: inherit;
}
.ql-container.ql-snow {
	box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
	border-color: #e2e8f0;
	margin-top: -44px;
}
.ql-editor {
	overflow-y: visible; 
	padding-top: 64px;
}
.ql-scrolling-container {
	height: 100%;
	min-height: 100%;
	overflow-y: auto;
}

.ql-editor.ql-blank::before {
    color: #a0aec0;
    font-style: normal;
}
.ql-editor:focus {
	border-radius: 0.5rem;
	box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.5);
}

.ql-editor h1,
.ql-editor h2,
.ql-editor h3 {
	font-size: 1.75rem !important;
	font-weight: 700;
	color: #2d3748;
	border-bottom: 0;
	margin-bottom: 0.75em;
	line-height: 1.2;
}
.ql-editor p,
.ql-editor ul,
.ql-editor ol,
.ql-snow .ql-editor pre {
	margin-bottom: 1em;
}
.ql-editor strong {
	font-weight: 700;
}
.ql-editor ol, 
.ql-editor ul {
	padding-left: 0;
}
.ql-editor li {
	margin-bottom: 0.25em;
}
.ql-editor a {
	color: #4299e1;
}
.ql-editor blockquote {
	position: relative;
	display: block;
	margin-top: 1.875em !important;
	margin-bottom: 1.875em !important;
	font-size: 1.875rem;
	line-height: 1.2;
	border-left: 3px solid #cbd5e0;
	font-weight: 600;
	color: #4a5568;
	font-style: normal;
	letter-spacing: -0.05em;
}
.ql-snow .ql-editor pre {
	display: block;
	border-radius: 0.5rem;
	padding: 1rem;
	font-size: 1rem;
}
.ql-snow .ql-editor img {
	border-radius: 0.5rem;
	box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.05);
}
.ql-editor iframe {
	width: 100%;
	max-width: 100%;
	height: 400px;
}
</style>
@endpush


@push('scripts')
<script src="https://unpkg.com/quill@1.3.7/dist/quill.js" defer data-turbolinks-track="reload"></script>
<script src="https://unpkg.com/quill-paste-smart@latest/dist/quill-paste-smart.js" defer data-turbolinks-track="reload"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/quill-magic-url@2.0.1/dist/index.min.js" defer data-turbolinks-track="reload"></script> --}}
@endpush

