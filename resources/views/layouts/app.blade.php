<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="turbolinks-cache-control" content="no-cache">
        <meta name="csrf-token" content="{{ csrf_token() }}" >
        <title>@yield('title', setting('site_name'))</title>

        <link rel="dns-prefetch" href="//fonts.googleapis.com" />
        <link rel="dns-prefetch" href="//unpkg.com">
		<link rel="dns-prefetch" href="//pagecdn.io" />
        <link rel="dns-prefetch" href="//cdn.jsdelivr.net" />
        <link rel="dns-prefetch" href="//cdnjs.cloudflare.com" />

        <meta name="keywords" content="@yield('meta_keywords', '')">
        <meta name="title" content="@yield('meta_title', setting('site_seo_title'))">
        <meta name="description" content="@yield('meta_description', setting('site_seo_description'))">
        <link rel="canonical" href="{{ url()->current() }}"/>

        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:title" content="@yield('meta_title', setting('site_seo_title'))">
        <meta property="og:description" content="@yield('meta_description', setting('site_seo_description'))">

        <!-- Twitter -->
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:url" content="{{ url()->current() }}">
        <meta property="twitter:title" content="@yield('meta_title', setting('site_seo_title'))">
        <meta property="twitter:description" content="@yield('meta_description', setting('site_seo_description'))">

        @include('flowcms::partials.css.common')

    </head>
    <body class="bg-gray-200 antialiased leading-normal text-gray-600 flex flex-col min-h-screen">

        <div class="flex-1">
            @yield('content')
        </div>

        @include('flowcms::partials.cms.admin.footer')

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
                let newText = el.innerHTML.replace(/((http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?)/g, '<a class="text-indigo-500 underline underline-indigo-200" target="_blank" rel="noopener" href="$1">$1</a>');
                el.innerHTML = newText;
            });
        </script>

        @yield('bottom-scripts')
	</body>
</html>
