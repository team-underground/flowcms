<footer>
	<x-flowcms-section-centered>
		<div class="flex flex-wrap items-center justify-between">
			<div class="w-full md:w-1/2">
				<div class="text-sm inline-flex">&copy; {!! markdownLinkParser(setting('footer_text')) !!}</div>
			</div>
			<div class="w-full md:w-1/2 md:text-right">
				<a data-turbolinks="false" href="/docs" target="_blank" class="text-sm inline-flex hover:underline hover:text-indigo-500 mr-4">Docs</a>
				<a href="{{ route('flowcms::blog') }}" class="text-sm inline-flex hover:underline hover:text-indigo-500 mr-4">Blog</a>
			</div>
		</div>
		{{-- <div class="md:flex md:justify-between">
			<div class="mt-2 text-sm inline-flex">&copy; {!! markdownLinkParser(setting('footer_text')) !!}</div>
			<span class="text-sm inline-flex">Made in Guwahati.</span>
		</div> --}}
	</x-flowcms-section-centered>
</footer>
