<?php

return [
    'site' => [
        'title' => 'Site Settings',
        'desc' => 'Settings for application.',

        'elements' => [
            [
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'site_name', // unique name for field
                'label' => 'Site Name', // you know what label it is
                'rules' => 'required|min:2|max:50', // validation rule of laravel
                'class' => '', // any class for input
                'value' => env('SITE_NAME', 'Flowcms'), // default value if you want
                'placeholder' => 'Site Name'
            ],

            [
                'type' => 'text',
                'data' => 'string',
                'name' => 'site_logo',
                'label' => 'Site Logo URL',
                'rules' => 'nullable|url',
                'class' => '',
                'value' => env('SITE_LOGO_URL', config('app.url') . '/cms/flowcms-logo.svg'),
                'placeholder' => 'eg. http://landing.test/cms/flowcms-logo.svg'
            ],

            [
                'type' => 'text',
                'data' => 'string',
                'name' => 'site_logo_white',
                'label' => 'Site Logo URL (white version)',
                'rules' => 'nullable|url',
                'class' => '',
                'value' => env('SITE_LOGO_URL_WHITE', config('app.url') . '/cms/flowcms-white.svg'),
                'placeholder' => 'eg. http://landing.test/cms/flowcms-logo-white.svg'
            ],
            [
                'type' => 'text',
                'data' => 'string',
                'name' => 'site_homepage_url',
                'label' => 'Site Homepage',
                'rules' => 'sometimes|required',
                'class' => '',
                'value' => env('SITE_HOME', 'blog'),
                'placeholder' => 'slug of your page'
            ],
            [
                'type' => 'text',
                'data' => 'string',
                'name' => 'site_seo_title',
                'label' => 'Site Meta Title',
                'rules' => 'nullable',
                'class' => '',
                'value' => '',
                'placeholder' => 'SEO meta title'
            ],
            [
                'type' => 'textarea',
                'data' => 'string',
                'name' => 'site_seo_description',
                'label' => 'Site Meta Description',
                'rules' => 'nullable',
                'class' => '',
                'value' => '',
                'placeholder' => 'SEO meta description'
            ]
        ]
    ],

    'site_credential' => [
        'title' => 'Site Credentials',
        'desc' => 'Settings for admin credential.',
        'elements' => [
            [
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'site_admin', // unique name for field
                'label' => 'Site Admin Email', // you know what label it is
                'rules' => 'required|email|max:100', // validation rule of laravel
                'class' => '', // any class for input
                'value' => env('SITE_ADMIN', 'admin@admin.com'), // default value if you want
                'placeholder' => 'Site Admin Email'
            ],
        ]
    ],

    'site_menu' => [
        'title' => 'Menu Settings',
        'desc' => 'Settings for login and register menu.',

        'elements' => [
            [
                'type' => 'text',
                'data' => 'string',
                'name' => 'login_text',
                'label' => 'CTA Text',
                'rules' => 'nullable',
                'class' => '',
                'value' => '',
                'placeholder' => 'eg. Login or Sign in'
            ],
            [
                'type' => 'text',
                'data' => 'string',
                'name' => 'login_url',
                'label' => 'CTA URL',
                'rules' => 'nullable',
                'class' => '',
                'value' => '',
                'placeholder' => 'eg. http://yourdomain.com/login'
            ]
        ]
    ],

    'site_footer' => [
        'title' => 'Footer',
        'desc' => 'Settings for site footer.',

        'elements' => [
            [
                'type' => 'text',
                'data' => 'string',
                'name' => 'footer_text',
                'label' => 'Footer Text',
                'rules' => 'required',
                'class' => '',
                'value' => '2020 Flowcms. All rights reserved.',
                'placeholder' => 'Footer text...'
            ],
            [
                'type' => 'text',
                'data' => 'string',
                'name' => 'twitter',
                'label' => 'Twitter',
                'rules' => 'nullable|url',
                'class' => '',
                'value' => '',
                'placeholder' => 'eg. https://twitter.com/app_name'
            ],
            [
                'type' => 'text',
                'data' => 'string',
                'name' => 'facebook',
                'label' => 'Facebook',
                'rules' => 'nullable|url',
                'class' => '',
                'value' => '',
                'placeholder' => 'eg. https://facebook.com/app_name'
            ],
            [
                'type' => 'text',
                'data' => 'string',
                'name' => 'instagram',
                'label' => 'Instagram',
                'rules' => 'nullable|url',
                'class' => '',
                'value' => '',
                'placeholder' => 'eg. https://instagram.com/app_name'
            ],
            [
                'type' => 'text',
                'data' => 'string',
                'name' => 'linkedin',
                'label' => 'Linkedin',
                'rules' => 'nullable|url',
                'class' => '',
                'value' => '',
                'placeholder' => 'eg. https://linkedin.com/app_name'
            ],
            [
                'type' => 'text',
                'data' => 'string',
                'name' => 'github',
                'label' => 'Github',
                'rules' => 'nullable|url',
                'class' => '',
                'value' => '',
                'placeholder' => 'eg. https://github.com/app_name'
            ]
        ]
    ],

    'site_article' => [
        'title' => 'Article',
        'desc' => 'Settings related to articles.',

        'elements' => [
            [
                'type' => 'text',
                'data' => 'string',
                'name' => 'disqus_shortname',
                'label' => 'Disqus Shortname',
                'rules' => 'nullable',
                'class' => '',
                'value' => '',
                'placeholder' => '',
                'hint' => 'It displays the comment form inside your article single page. You can find your disqus shortname after signing up and visiting http://disqus.com/admin/settings/'
            ],
        ]
    ],

    'site_google_analytics' => [
        'title' => 'Google Analytics Settings',
        'desc' => 'Settings to track page views on your website',

        'elements' => [
            [
                'type' => 'text',
                'data' => 'string',
                'name' => 'google_analytics',
                'label' => 'Google Analytics Tracking ID',
                'rules' => 'nullable',
                'class' => '',
                'value' => '',
                'placeholder' => '',
                'hint' => 'Provide a Google Analytics https://analytics.google.com/analytics/web tracking id in format XX-XXXXXXXXX-X'
            ]
        ]
    ],

    'site_font_settings' => [
        'title' => 'Font Settings',
        'desc' => 'Apply font settings for headings for landing pages',

        'elements' => [
            [
                'type' => 'select',
                'data' => 'string',
                'name' => 'site_font_heading',
                'label' => 'Heading Fonts',
                'rules' => 'nullable',
                'class' => '',
                'value' => 'DM Serif Display',
                'options' => [
                    'DM Serif Display',
                    'Hepta Slab',
                    'Maitree',
                    'Crimson Pro',
                    'Lora'
                ],
                'placeholder' => '',
                'hint' => 'Provide a Google Analytics https://analytics.google.com/analytics/web tracking id in format XX-XXXXXXXXX-X'
            ]
        ]
    ]
];
