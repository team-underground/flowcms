@foreach(range(1, 10) as $range)
	<div class="mb-6 md:mb-8 md:px-4 w-full">
		<x-flowcms-card class="animate-pulse flex flex-wrap md:items-center overflow-hidden -mx-4">
			<div class="w-full md:w-2/3 px-4">
				<div class="py-2">
					<div class="mb-4 flex space-x-4">
						<span class="w-16 leading-none inline-block rounded-lg text-transparent bg-gray-300">{{ str_repeat('_', rand(18, 30))}}</span>
						<span class="w-16 leading-none inline-block rounded-lg text-transparent bg-gray-300">{{ str_repeat('_', rand(18, 30))}}</span>
						<span class="w-16 leading-none inline-block rounded-lg text-transparent bg-gray-300">{{ str_repeat('_', rand(18, 30))}}</span>
					</div>

					<div class="mb-5">
						<div><span class="leading-none inline-block text-transparent bg-gray-300 rounded-lg">{{ str_repeat('_', rand(50, 70))}}</span></div>
						<div><span class="leading-none inline-block text-transparent bg-gray-300 rounded-lg">{{ str_repeat('_', rand(18, 30))}}</span></div>
					</div>

					<div class="mb-2">
						<div><span class="leading-none inline-block text-transparent bg-gray-300 rounded-lg">{{ str_repeat('_', rand(30, 60))}}</span></div>
						<div><span class="leading-none inline-block text-transparent bg-gray-300 rounded-lg">{{ str_repeat('_', rand(30, 60))}}</span></div>
						<div><span class="leading-none inline-block text-transparent bg-gray-300 rounded-lg">{{ str_repeat('_', rand(30, 60))}}</span></div>
					</div>
				</div>

				<div class="mt-auto pt-2 pb-6 text-transparent bg-gray-300 rounded-lg h-2 w-24"></div>
			</div>


			<div class="w-full md:w-1/3 order-first sm:order-last px-4">
				<div class="bg-gray-300 rounded-lg h-40"></div>
			</div>
		</x-flowcms-card>
	</div>
@endforeach
