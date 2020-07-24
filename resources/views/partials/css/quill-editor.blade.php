@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.1.1/styles/night-owl.min.css" rel="stylesheet">
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet" data-turbolinks-track="reload">
<style>
.ql-editor-haserror .ql-container.ql-snow {
	border-color: #f56565;
}
.ql-editor-haserror .ql-toolbar.ql-snow {
	border-color: #f56565;
	border-bottom-color: transparent;
}
.ql-toolbar.ql-snow {
    font-family: inherit;
	border-top-left-radius: 0.5rem;
  	border-top-right-radius: 0.5rem;
	background-color: #edf2f7;
	border-color: #e2e8f0;
}
.ql-container {
	color: #2d3748;
	font-family: inherit;
	font-size: inherit;
	border-bottom-left-radius: 0.5rem;
	border-bottom-right-radius: 0.5rem;		
}
.ql-container.ql-snow {
	box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
	border-color: #e2e8f0;
}
/* .ql-editor {
  height: 8em;
} */
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
.ql-editor p {
	margin-bottom: 1em;
}
.ql-editor strong {
	font-weight: 700;
}

.ql-editor ul,
.ql-editor ol {
	margin-bottom: 1em;
}
.ql-editor li {
	margin-bottom: 0.25em;
}
.ql-editor a {
	color: #4299e1;
	text-decoration: none;
	border-bottom: 1px solid #bee3f8;
}
.ql-editor blockquote {
	position: relative;
	display: block;
	margin-top: 1.875em !important;
	margin-bottom: 1.875em !important;
	font-size: 1.875rem;
	line-height: 1.2;
	padding-top: 0.75em;
	padding-bottom: 0.75em;
	border-top: 1px solid #cbd5e0;
	border-bottom: 1px solid #cbd5e0;
	font-weight: 600;
	color: #4a5568;
	font-style: normal;
	text-align: center;
	letter-spacing: -0.05em;
}
.ql-editor blockquote:before,
.ql-editor blockquote:after {
	position: absolute;
	left: 0;
	right: 0;
	display: block;
	font-family: inherit;
	font-size: 0.7rem;
	font-style: normal;
	text-transform: uppercase;
	letter-spacing: 0.1em;
	color: #a0aec0;
	background-color: #fff;
	width: 120px;
	margin-left: auto;
	margin-right: auto;
	text-align: center;
}
.ql-editor blockquote:before {
	content: "<Blockquote>";
	top: -9px;
}
.ql-editor blockquote:after {
	content: "</Blockquote>";
	bottom: -6px;
}
.ql-editor pre {
	border-radius: 0.5rem;
	padding: 1rem;
	margin-bottom: 1em;
	font-size: 1rem;
}
.ql-editor iframe {
	width: 100%;
	max-width: 100%;
	height: 400px;
}
</style>
@endpush

@push('scripts')
<script src="https://cdn.quilljs.com/1.3.6/quill.js" data-turbolinks-track="reload"></script>
@endpush
