<?php

/**
 * type
 * - text
 * - url
 * - textarea
 * - boolean
 *
 */

return [
    'constants' => [
        'TEXT' => 'text',
        'TEXTAREA' => 'textarea',
        'URL' => 'url',
        'CHECKBOX' => 'checkbox'
    ],

    'blocks' => [
        'services' => [
            [
                'field' => 'icon',
                'type' => 'text',
                "rules" => ['required'],
                "order" => 0
            ],
            [
                'field' => 'title',
                'type' => 'text',
                "rules" => ['required'],
                "order" => 1
            ],
            [
                'field' => 'content',
                'type' => 'textarea',
                "rules" => ['required'],
                "order" => 2
            ]
            // [
            // 	'field' => 'link_url',
            // 	'type' => 'text',
            // 	"rules" => ['nullable', "required", 'url'],
            // 	"order" => 3
            // ],
            // [
            // 	'field' => 'link_text',
            // 	'type' => 'text',
            // 	"rules" => ['nullable', 'required'],
            // 	"order" => 4
            // ]
        ],
        'cta' => [
            [
                'field' => 'title',
                'type' => 'text',
                "rules" => ['required'],
                "order" => 0
            ],
            [
                'field' => 'content',
                'type' => 'textarea',
                "rules" => ['required'],
                "order" => 1
            ],
            [
                'field' => 'link_url',
                'type' => 'text',
                "rules" => ['required', 'url'],
                "order" => 2
            ],
            [
                'field' => 'link_text',
                'type' => 'text',
                "rules" => ['required'],
                "order" => 3
            ]
        ],
        'cta_centered' => [
            [
                'field' => 'title',
                'type' => 'text',
                "rules" => ['required'],
                "order" => 0
            ],
            [
                'field' => 'content',
                'type' => 'textarea',
                "rules" => ['required'],
                "order" => 1
            ],
            [
                'field' => 'link_url',
                'type' => 'text',
                "rules" => ['required', 'url'],
                "order" => 2
            ],
            [
                'field' => 'link_text',
                'type' => 'text',
                "rules" => ['required'],
                "order" => 3
            ]
        ],
        'testimonial' => [
            [
                'field' => 'content',
                'type' => 'textarea',
                "rules" => ['required'],
                "order" => 0
            ],
            [
                'field' => 'title',
                'type' => 'text',
                "rules" => ['required'],
                "order" => 1
            ],
            [
                'field' => 'image',
                'type' => 'text',
                "rules" => ['required', 'url'],
                "order" => 2
            ]
        ],
        'hero' => [
            [
                'field' => 'title',
                'type' => 'text',
                "rules" => ['required'],
                "order" => 1
            ],
            [
                'field' => 'content',
                'type' => 'textarea',
                "rules" => ['required'],
                "order" => 2
            ],
            [
                'field' => 'link_url',
                'type' => 'text',
                "rules" => ['nullable', 'url'],
                "order" => 3
            ],
            [
                'field' => 'link_text',
                'type' => 'text',
                "rules" => ['nullable'],
                "order" => 4
            ],
            [
                'field' => 'image_url',
                'type' => 'text',
                "rules" => ["required", 'url'],
                "order" => 3
            ]
        ],
        'hero_centered' => [
            [
                'field' => 'title',
                'type' => 'text',
                "rules" => ['required'],
                "order" => 1
            ],
            [
                'field' => 'content',
                'type' => 'textarea',
                "rules" => ['required'],
                "order" => 2
            ],
            [
                'field' => 'link_url',
                'type' => 'text',
                "rules" => ['nullable', 'url'],
                "order" => 3
            ],
            [
                'field' => 'link_text',
                'type' => 'text',
                "rules" => ['nullable'],
                "order" => 4
            ],
            [
                'field' => 'image_url',
                'type' => 'text',
                "rules" => ["required", 'url'],
                "order" => 3
            ]
        ],
        'hero_image_left' => [
            [
                'field' => 'title',
                'type' => 'text',
                "rules" => ['required'],
                "order" => 1
            ],
            [
                'field' => 'content',
                'type' => 'textarea',
                "rules" => ['required'],
                "order" => 2
            ],
            [
                'field' => 'link_url',
                'type' => 'text',
                "rules" => ['nullable', 'url'],
                "order" => 3
            ],
            [
                'field' => 'link_text',
                'type' => 'text',
                "rules" => ['nullable'],
                "order" => 4
            ],
            [
                'field' => 'image_url',
                'type' => 'text',
                "rules" => ["required", 'url'],
                "order" => 3
            ]
        ],
        'hero_image_right' => [
            [
                'field' => 'title',
                'type' => 'text',
                "rules" => ['required'],
                "order" => 1
            ],
            [
                'field' => 'content',
                'type' => 'textarea',
                "rules" => ['required'],
                "order" => 2
            ],
            [
                'field' => 'link_url',
                'type' => 'text',
                "rules" => ['nullable', 'url'],
                "order" => 3
            ],
            [
                'field' => 'link_text',
                'type' => 'text',
                "rules" => ['nullable'],
                "order" => 4
            ],
            [
                'field' => 'image_url',
                'type' => 'text',
                "rules" => ["required", 'url'],
                "order" => 3
            ]
        ],
        'faqs' => [
            [
                'field' => 'title',
                'type' => 'text',
                "rules" => ['required'],
                "order" => 0
            ],
            [
                'field' => 'content',
                'type' => 'textarea',
                "rules" => ['required'],
                "order" => 1
            ]
        ],
        'contact_us' => [
            [
                'field' => 'title',
                'type' => 'text',
                "rules" => ['required'],
                "order" => 0
            ],
            [
                'field' => 'name',
                'type' => 'checkbox',
                "rules" => ['required'],
                "value" => 'name',
                "order" => 1,
            ],
            [
                'field' => 'email',
                'type' => 'checkbox',
                "rules" => ['required', 'email'],
                "value" => 'email',
                "order" => 2
            ],
            [
                'field' => 'phone',
                'type' => 'checkbox',
                "rules" => ['nullable'],
                "value" => 'phone',
                "order" => 3
            ],
            [
                'field' => 'body',
                'type' => 'checkbox',
                "rules" => ['required'],
                "value" => 'body',
                "order" => 4
            ],
            // [
            // 	'field' => 'name',
            // 	'type' => 'checkbox',
            // 	"rules" => ['required'],
            // 	"order" => 1
            // ],
            // [
            // 	'field' => 'email',
            // 	'type' => 'checkbox',
            // 	"rules" => ['required', 'email'],
            // 	"order" => 2
            // ],
            // [
            // 	'field' => 'phone',
            // 	'type' => 'checkbox',
            // 	"rules" => ['nullable'],
            // 	"order" => 3
            // ],
            // [
            // 	'field' => 'message',
            // 	'type' => 'textarea',
            // 	"rules" => ['required'],
            // 	"order" => 4
            // ]
        ]

    ]
];
