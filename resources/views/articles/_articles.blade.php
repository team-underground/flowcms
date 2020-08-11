@if ($articles->isNotEmpty())
    <x-flowcms-base-datatable
        :headings="['Title', 'Views', 'Category', 'Published Date', 'Status', 'Actions']"
        :values="[
            [
                'key' => 'title', 
                'type' => 'data',
                'width' => 'w-64'
            ],
            [
                'key' => 'article_views', 
                'type' => 'data',
            ],
            [
                'key' => 'category.name', 
                'type' => 'data',
            ],
            [
                'key' => 'publish_date', 
                'type' => 'date',
			],
			[
                'key' => 'article_status', 
                'type' => 'data',
                'theme' => [
                    'type' => 'badge',
                    'colors' => [
                        'Published' => 'bg-green-200 text-green-700',
                        'Draft' => 'bg-orange-200 text-orange-700',
                    ]
                ]
            ],
            [
				'key' => 'action', 
				'type' => ['delete', 'edit']
			]
        ]"
        :data="$articles"
        model="articles"
        edit-route="flowcms::articles.edit"
        edit-id="uuid"
        delete-route="flowcms::articles.destroy"
        delete-id="uuid"
        table-striped
    >
    </x-flowcms-base-datatable> 
@else
    No articles found. 
@endif