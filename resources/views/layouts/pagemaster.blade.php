<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="turbolinks-cache-control" content="no-cache">
		<title>{{ $page->title }} - {{ setting('site_name') }}</title>

		<link rel="dns-prefetch" href="//fonts.googleapis.com" />
		<link rel="dns-prefetch" href="//pagecdn.io" />
		<link rel="dns-prefetch" href="//cdn.jsdelivr.net" />

		<meta name="title" content="{{ $page->seo_title ?? $page->title }} - {{ setting('site_name') }}">
        <meta name="description" content="{{ $page->seo_description ?? setting('site_seo_description') }}">
		<link rel="canonical" href="{{ url()->current() }}"/>

		<!-- Open Graph / Facebook -->
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:title" content="{{ $page->seo_title ?? $page->title }} - {{ setting('site_name') }}">
        <meta property="og:description" content="{{ $page->seo_description ?? setting('site_seo_description') }}">

        <!-- Twitter -->
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:url" content="{{ url()->current() }}">
        <meta property="twitter:title" content="{{ $page->seo_title ?? $page->title }} - {{ setting('site_name') }}">
        <meta property="twitter:description" content="{{ $page->seo_description ?? setting('site_seo_description') }}">

		@include('flowcms::partials.css.common')

		<script>
			document.addEventListener('DOMContentLoaded', () => {
				document.getElementById('js-content').classList.add('animate', 'fadeIn');
			});
			document.addEventListener('turbolinks:load', () => {
				document.getElementById('js-content').classList.add('animate', 'fadeIn');
			});
		</script>
    </head>
    <body class="bg-gray-200 text-gray-600 antialiased leading-normal flex flex-col min-h-screen">

		<div class="bg-transparent">
			<div class="md:max-w-6xl md:mx-auto pt-2 px-4">
				@include('flowcms::partials.cms.admin.navbarInverse')
			</div>
		</div>

		<div class="flex-1" id="js-content" class="transition-fade">
			<x-flowcms-section-centered>
				<div class="md:max-w-3xl md:mx-auto text-center">
					<h2 class="heading text-gray-800 text-3xl sm:text-4xl">{{ $page->display_title ?? $page->title }}</h2>

					@isset($page->body)
						<div class="main-content text-gray-600 mt-4 help-text email-links">
							@nl2br($page->body)
						</div>
					@endisset
				</div>
			</x-flowcms-section-centered>

			@yield('page-content')

		</div>

        @include('flowcms::partials.cms.front.footer')

		<script>
			 document.querySelectorAll("textarea").forEach(el => {
                el.style.height = el.setAttribute(
                    "style",
                    "height: " + el.scrollHeight + "px"
                );
                el.classList.add("auto");
                el.addEventListener("input", e => {
                    el.style.height = "auto";
                    el.style.height = el.scrollHeight + "px";
                });
            });
			document.querySelectorAll(".help-text").forEach(el => {
                let newText = el.innerHTML.replace(/((http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?)/g, '<a class="text-indigo-500 underline" target="_blank" rel="noopener" href="$1">$1</a>');
                el.innerHTML = newText;
            });
			document.querySelectorAll(".email-links").forEach(el => {
				let newText = el.innerHTML.replace(/([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3})/g, '<a class="text-indigo-500 underline" target="_blank" rel="noopener" href="mailto:$1">$1</a>');
				el.innerHTML = newText;
			});
		</script>
	</body>
</html>
