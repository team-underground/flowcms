<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"  data-turbolinks-track="true">
<link href="https://pagecdn.io/lib/tailwindcss/1.4.5/tailwind.min.css" rel="stylesheet" crossorigin="anonymous"  data-turbolinks-track="true" />
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.3.5/dist/alpine.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/turbolinks/5.2.0/turbolinks.js"></script>

@if(setting('site_font_heading') === 'Hepta Slab')
	<link href="https://fonts.googleapis.com/css2?family=Hepta+Slab:wght@500&display=swap" rel="stylesheet">
	<style>.heading { font-family: 'Hepta Slab', 'DM Serif Display', serif; }</style>
@elseif(setting('site_font_heading') === 'Maitree')
	<link href="https://fonts.googleapis.com/css2?family=Maitree:wght@500&display=swap" rel="stylesheet">
	<style>.heading { font-family: 'Maitree', 'DM Serif Display', serif; }</style>
@elseif(setting('site_font_heading') === 'Crimson Pro')
	<link href="https://fonts.googleapis.com/css2?family=Crimson+Pro:wght@500&display=swap" rel="stylesheet">
	<style>.heading { font-family: 'Crimson Pro', 'DM Serif Display', serif; }</style>
@elseif(setting('site_font_heading') === 'Lora')
	<link href="https://fonts.googleapis.com/css2?family=Lora:wght@500&display=swap" rel="stylesheet">
	<style>.heading { font-family: 'Lora', 'DM Serif Display', serif; }</style>
@else
	<link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&display=swap" rel="stylesheet"  data-turbolinks-track="true">
	<style>.heading { font-family: 'DM Serif Display', serif; }</style>
@endif

<style>
[x-cloak] { display: none; }
html {
	scroll-behavior: smooth;
}
body {
	font-family: 'Inter', sans-serif;
}
.underline-indigo-200 {
	text-decoration-color: #c3dafe;
}
.underline-indigo-200:hover {
	text-decoration-color: #7f9cf5;
}
.underline-red-200 {
	text-decoration-color: #fed7d7;
}
.underline-red-200:hover {
	text-decoration-color: #fc8181;	
}
.heading {
	font-weight: 500;
	letter-spacing: -0.025em;
}
.animate {
	-webkit-animation-duration: 1s;
	animation-duration: 1s;
	-webkit-animation-fill-mode: both;
	animation-fill-mode: both;
}
@-webkit-keyframes fadeIn {
	from {
		opacity: 0;
	}
	to {
		opacity: 1;
	}
}
@keyframes fadeIn {
	from {
		opacity: 0;
	}
	to {
		opacity: 1;
	}
}
.fadeIn {
	-webkit-animation-name: fadeIn;
	animation-name: fadeIn;
}

@keyframes spinner {
	to {
		transform: rotate(360deg);
	}
}
.base-spinner {
	position: relative;
	overflow: hidden;
}
.base-spinner:before {
	content: "";
	box-sizing: border-box;
	position: absolute;
	background-color: inherit;
	width: 100%;
	height: 100%;
	display: block;
	z-index: 1;
	top: 0;
	left: 0;
}
.base-spinner:after {
	content: "";
	box-sizing: border-box;
	position: absolute;
	top: 50%;
	left: 50%;
	width: 20px;
	height: 20px;
	margin-top: -10px;
	margin-left: -10px;
	border-radius: 50%;
	border: 2px solid rgba(255, 255, 255, 0.45);
	border-top-color: inherit;
	animation: spinner 0.6s linear infinite;
	z-index: 2;
}
.form-checkbox {
	-webkit-appearance: none;
	-moz-appearance: none;
	appearance: none;
	-webkit-print-color-adjust: exact;
	color-adjust: exact;
	display: inline-block;
	vertical-align: middle;
	background-origin: border-box;
	-webkit-user-select: none;
	-moz-user-select: none;
	-ms-user-select: none;
	user-select: none;
	flex-shrink: 0;
	color: currentColor;
	background-color: #fff;
	border-color: #e2e8f0;
	border-width: 1px;
	border-radius: 0.25rem;
	height: 1.2em;
	width: 1.2em;
}

.form-checkbox:checked {
	background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3cpath d='M5.707 7.293a1 1 0 0 0-1.414 1.414l2 2a1 1 0 0 0 1.414 0l4-4a1 1 0 0 0-1.414-1.414L7 8.586 5.707 7.293z'/%3e%3c/svg%3e");
	border-color: transparent;
	background-color: currentColor;
	background-size: 100% 100%;
	background-position: center;
	background-repeat: no-repeat;
}
.grid-dotted {
	background-image: radial-gradient(currentColor 2px, transparent 2px);
	background-size: 16px 16px;
}
.grid-dotted-md {
	background-image: radial-gradient(currentColor 3px, transparent 3px);
	background-size: 16px 16px;
}
</style>

@stack('styles')
@stack('scripts')