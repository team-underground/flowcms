<footer>
	<x-flowcms-section-centered>
		<div class="flex flex-wrap items-center justify-between">
			<div class="w-full md:w-1/2">
				<span class="text-sm inline-flex">&copy;{!! markdownLinkParser(setting('footer_text')) !!}</span>
				{{-- <a href="#" class="text-sm inline-flex hover:underline hover:text-blue-500 mr-4">Terms</a>
				<a href="#" class="text-sm inline-flex hover:underline hover:text-blue-500 mr-4">Privacy</a>
				<a href="#" class="text-sm inline-flex hover:underline hover:text-blue-500 mr-4">Help</a>
				<span class="md:hidden">
					<a href="#" class="text-sm inline-flex hover:underline hover:text-blue-500 mr-4">Docs</a>
					<a href="#" class="text-sm inline-flex hover:underline hover:text-blue-500 mr-4">Blog</a>
					<span class="text-sm inline-flex">Made in Guwahati.</span>
				</span> --}}
			</div>

			<div class="w-full md:w-1/2 md:text-right">
				@if(setting('twitter'))
					<a href="{{ setting('twitter') }}" class="text-sm inline-flex hover:underline hover:text-indigo-500 mr-4">
						Twitter
					</a>
				@endif

				@if(setting('facebook'))
					<a href="{{ setting('facebook') }}" class="text-sm inline-flex hover:underline hover:text-indigo-500 mr-4">
						Facebook
					</a>
				@endif

				@if(setting('instagram'))
					<a href="{{ setting('instagram') }}" class="text-sm inline-flex hover:underline hover:text-indigo-500 mr-4">
						Instagram
					</a>
				@endif

				@if(setting('linkedin'))
					<a href="{{ setting('linkedin') }}" class="text-sm inline-flex hover:underline hover:text-indigo-500 mr-4">
						Linkedin
					</a>
				@endif

				@if(setting('github'))
					<a href="{{ setting('github') }}" class="text-sm inline-flex hover:underline hover:text-indigo-500">
						Github
					</a>
				@endif
			</div>
		</div>
	</x-flowcms-section-centered>
</footer>
