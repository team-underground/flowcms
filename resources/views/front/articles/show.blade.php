@extends('flowcms::layouts.front')

@section('title')
{{ $article->title }} - Blog
@stop

@section('meta_title')
{{ $article->title }}
@stop

@section('meta_description')
{{ $article->seo_description ?? $article->article_summary }}
@stop

@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.1.1/styles/night-owl.min.css" rel="stylesheet">
<style>
.article-content h1,
.article-content h2,
.article-content h3 {
	font-size: 1.75rem;
	font-weight: 700;
	color: #2d3748;
	border-bottom: 0;
	margin-bottom: 0.75em;
	line-height: 1.2;
}

.article-content div,
.article-content p,
.article-content ol,
.article-content ul {
	margin-bottom: 1rem;
}

.article-content strong {
	font-weight: 700;
}

.article-content li {
	position: relative;
	padding-left: 1.5em;
	margin-bottom: 1rem;
}
.article-content ul li:before {
	content: "";
	position: absolute;
	top: 10px;
	left: 0;
	content: "";
	width: 6px;
	height: 6px;
	background-color: #667eea;
	border-radius: 50%;
	display: inline-block;
}

.article-content ol {
	counter-reset: custom-counter;
}
.article-content ol li:before {
	counter-increment: custom-counter;
	position: absolute;
	top: 3px;
	left: 0;
	content: counter(custom-counter) ".";
	display: inline-block;
	font-size: 0.85em;
	font-weight: 500;
	color: #667eea;
	text-align: right;
}

.article-content li {
	margin-bottom: 0.25em;
}

.article-content a {
color: #667eea;
text-decoration: underline;
text-decoration-color: hsla(229, 76%, 66%, 0.2);
-moz-text-decoration-color: hsla(229, 76%, 66%, 0.2);
}
.article-content a:hover {
text-decoration-color: hsla(229, 76%, 66%, 0.8);
-moz-text-decoration-color: hsla(229, 76%, 66%, 0.8);
}

.article-content blockquote {
	position: relative;
	display: block;
	margin-top: 1.875em;
	margin-bottom: 1.875em;
	/* font-size: 1.875rem; */
	font-size: 2.25rem;
	line-height: 1.2;
	padding-top: 1em;
	padding-bottom: 1em;
	border-top: 1px solid #cbd5e0;
	border-bottom: 1px solid #cbd5e0;
	font-weight: 400;
	color: #2d3748;
	font-style: normal;
	text-align: center;
	letter-spacing: -0.02em;
	font-family: 'DM Serif Display', 'Inter', sans-serif;
}

.article-content blockquote:before,
.article-content blockquote:after {
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
	background-color: #edf2f7;
	width: 40px;
	margin-left: auto;
	margin-right: auto;
	text-align: center;
}

.article-content blockquote:before {
	/* content: "<Blockquote>"; */
	content: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAABR0lEQVRIS92VO1LDMBRFr+yGlhUQWmYUQgF2SSmosoOwBHaAswRWADuADtHZnZ0GEXsBWQItTR5jk9iy4480Qwqi0nPmnef79GHY82J7ro8DF/CrmynYesaA0TJ5v+iLs4ttjejs8nbiOusXAKNtUZfhVMVy1ZQMsTsC7os7EJ7KQoSIHARZLMNmcRO2Jth087EtxBjmy1gGbdGYsjUB94QCcJ4XJLDHLHm778rdlC0Fv0OiPPdiud9Hx0q9frUJbNhK4ItnEGaNgiERwmwh5/p3bsGWgrEnVgSctHXMQErfpjZs9QeeoL59rg+cW7DGAhCidCGv8yaGBDprLgCQJrLgBwUaazSDIjrtD/pm0GQrgS8CIjx0zUGfwdiC7TxoDdFnmshJbatqh7KP3bmLNt1NixNNiJiDsOu6MGEP/MH5i/f6/0f0A40qxBmfrS42AAAAAElFTkSuQmCC");
	top: -11px;
	/* left: 0; */
}

.article-content blockquote:after {
	content: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAABV0lEQVRIS+2VMVLDMBBF/7qh5Qihx+A0iTtcii6cgHAChhMAN+AI4QauiOgoo9AkNkNLOAEtjS1GHkfIjh3Jhbuos/z2/5V2JRF6HtSzPg4G1h3e2aKzkD1IiQsAEUGucknxx5I/Nim5sBUDf8xWAM7rYsooEa9Dc96V1QZlNvdtaybQXSLmT+p/F1YbtGVkGG5SwU/UdxfWNJC2iqWCF7w/Zs5slxXAMGislZnglnWugQreBtlqYLJOXaQCCPhOBB9ss7TUYZ0KHpRx1Z0vsssRgYqz8D8Iz+mCT80pF7b1LgqCyXF29PujBSVdpct53NQI+9hWAz9kM0hcl4J6yU0G+9hGg3oRs9wbfr6/qM7ZGTa2YnAasogk1GmOtBLhJl3wWV3ZH11OQPLWxmqDIGSDTOLLEFpnuTdtyrwLW23TEXuDhw1yitsKqtvUkT28aLb7sf9H/w+WJMoZbi1gvwAAAABJRU5ErkJggg==");
	bottom: -12px;
	/* right: 0; */
}
.article-content pre {
	border-radius: 0.5rem;
	padding: 1rem;
	margin-bottom: 1em;
	font-size: 1rem;
}
.article-content img,
.article-content iframe {
	border-radius: 0.5rem;
	max-width: 100%;
	width: 100%;
}

.article-content iframe {
	height: 400px;
}


/* LIGHTBOX BACKGROUND */
#lightbox-background {
  position: fixed;
  top: 0;
  left: 0;
  width: 100vw;
  height: 100vh;
  background: rgba(0, 0, 0, 0.45);
  z-index: 999;
  visibility: hidden;
  opacity: 0;
  transition: all ease 0.3s;
  overflow-y: auto;
}

#lightbox-background.show {
  visibility: visible;
  opacity: 1;
}

/* LIGHTBOX IMAGE */
#lightbox-img {
  position: relative;
  top: 50%;
  transform: translateY(-50%);
  text-align: center;
}
#lightbox-img img {
	width: 100%;
  	height: 100vh;
  	object-fit: contain;
}
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sharer.js@0.4.0/sharer.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.1.1/highlight.min.js" data-turbolinks-track="reload"></script>
<script>
	document.addEventListener('turbolinks:load', () => {
		document.querySelectorAll('pre').forEach((block) => {
			hljs.highlightBlock(block);
		})


		document.querySelectorAll('.article-content img').forEach((image) => {
			image.addEventListener('click', () => {
				// console.log(image.getAttribute('src'));
				// Create evil image clone
				let imgSource = image.getAttribute('src');
				let newImage = document.createElement('img');
				newImage.src = imgSource

				// Put clone into lightbox
				var lb = document.getElementById("lightbox-img");
				lb.innerHTML = "";
				lb.appendChild(newImage);

				// Show lightbox
				lb = document.getElementById("lightbox-background");
				lb.classList.add("show");
			});
		});

		// Click event to hide the lightbox
		document.getElementById("lightbox-background").addEventListener("click", function(){
			this.classList.remove("show");
		})

	})
</script>
@endpush

@section('content')
<div class="bg-transparent">
	<div class="md:max-w-6xl md:mx-auto pt-2 px-4">
		@include('flowcms::partials.cms.admin.navbarInverse')
	</div>
</div>

<div id="lightbox-background">
	<div id="lightbox-img"></div>
</div>

<x-flowcms-section-centered>
	<div class="mb-2 flex items-center text-sm md:text-base">
		<x-flowcms-link to="{{ route('flowcms::blog') }}">
			<svg class="w-4 h-4 mt-px inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
			Go back</x-flowcms-link>
		<div class="mx-3 text-gray-500 h-8 border-r" style="transform: rotate(15deg)"></div>
		<x-flowcms-link to="#">{{ $article->category->name }}</x-flowcms-link>
		<div class="mx-3 text-gray-500 h-8 border-r" style="transform: rotate(15deg)"></div>
		<div>{{ $article->published_date }}</div>
	</div>

	<h1 class="text-3xl md:text-5xl heading font-normal text-gray-800 md:max-w-4xl leading-tight">{{ $article->title }}</h1>

	<div class="my-3">By <x-flowcms-link to="#">{{ Str::title($article->user->name) }}</x-flowcms-link></div>

	@if ($article->image)
		<div class="w-full relative my-6" style="padding-bottom: 45%">
			<picture>
				<source media="(min-width: 750px)"
						srcset="{{ $article->images['large'] }}" />
				<source media="(min-width: 500px)"
						srcset="{{ $article->images['medium'] }}" />
				<source media="(max-width: 500px)"
						srcset="{{ $article->images['small'] }}" />

				<img
					src="{{ $article->image }}"
					alt="Article Image"
					loading="lazy"
					class="absolute shadow-sm w-full h-full object-cover rounded-lg">
			</picture>
		</div>
	@endif

	<div class="flex flex-col md:flex-row">
		<aside class="my-6 md:my-10 block">
			<h3 class="text-xs uppercase tracking-wider font-medium mb-2" id="sharer-heading">
				Share this article
			</h3>
			<ul class="flex flex-row md:flex-col space-x-5 md:space-x-0 md:space-y-5 leading-none md:w-16 md:mx-auto"
				x-data="{ title:document.title, url:window.location.href }" aria-labelledby="sharer-heading" x-init="
					function () {
						// Use a canonical URL if possible.
						var canonicalElement = document.querySelector('link[rel=canonical]');
						if (canonicalElement !== null) { url = canonicalElement.href; }
					}
				">
				<li x-show="navigator.share" class="flex justify-center">
					<button aria-label="Share using your device's share options"
						@click="navigator.share({title:title,url:url})">
						<img alt="" class="w-6 h-6" src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/icons/share-2.svg" />
					</button>
				</li>
				<li class="flex justify-center">
					<button aria-label="Share on Twitter" data-sharer="twitter" :data-title="title" :data-url="url">
						<img alt="" class="w-6 h-6" src="https://cdn.jsdelivr.net/npm/simple-icons@v2/icons/twitter.svg" />
					</button>
				</li>
				<li class="flex justify-center">
					<button aria-label="Share on Facebook" data-sharer="facebook" :data-url="url">
						<img alt="" class="w-6 h-6" src="https://cdn.jsdelivr.net/npm/simple-icons@v2/icons/facebook.svg" />
					</button>
				</li>
				<li class="flex justify-center">
					<button aria-label="Share on Linkedin" data-sharer="Linkedin" :data-url="url">
						<img alt="" class="w-6 h-6" src="https://cdn.jsdelivr.net/npm/simple-icons@v2/icons/linkedin.svg" />
					</button>
				</li>
				<li class="flex justify-center">
					<button aria-label="Share on Whatsapp" data-sharer="whatsapp" :data-title="title" :data-url="url">
						<img alt="" class="w-6 h-6" src="https://cdn.jsdelivr.net/npm/simple-icons@v2/icons/whatsapp.svg" />
					</button>
				</li>
				<li class="flex justify-center">
					<button aria-label="Share via Email" data-sharer="email" :data-title="title" :data-subject="title"
						:data-url="url" data-to="">
						<img alt="" class="w-6 h-6"
							src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/icons/mail.svg" />
					</button>
				</li>
			</ul>
		</aside>

		<div class="md:max-w-2xl md:mx-auto">
			<div class="md:my-10 article-content lg:text-lg text-gray-700">
				{!! $article->article_with_responsive_images !!}
			</div>

			@if(setting('disqus_shortname'))
				<x-flowcms-disqus />
			@endif
		</div>
	</div>

	<div class="flex justify-between mt-10">
		@isset($previous)
			<div class="w-1/2 flex-1">
				<h3 class="text-xs flex items-center uppercase tracking-wider font-medium mb-1" id="sharer-heading">
					<svg class="w-4 h-4 inline-block mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>Previous Article
				</h3>
				<x-flowcms-link class="md:text-lg lg:text-xl" to="{{ route('flowcms::blog.show', $previous->slug) }}">
					{{ $previous->title }}
				</x-flowcms-link>
			</div>
		@endisset

		@isset($next)
			<div class="text-right w-1/2 flex-1">
				<h3 class="text-xs flex items-center justify-end uppercase tracking-wider font-medium mb-1" id="sharer-heading">
					Next Article<svg class="ml-1 w-4 h-4 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
				</h3>
				<x-flowcms-link class="md:text-lg lg:text-xl" to="{{ route('flowcms::blog.show', $next->slug) }}">
					{{ $next->title }}
				</x-flowcms-link>
			</div>
		@endisset
	</div>
</x-flowcms-section-centered>
@endsection
