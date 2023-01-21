<?php

return [
    'entity' => [
        'mapping' => [
            'app' => base_path() . '/app/Entities/Mapping'
        ]
    ],
    'jwt' => [
        'expired_in_days' => 90
    ],
    'collection_paging' => [
        'size' => 100
    ],
    'env' => [
        'local' => [
            'rollbar_access_token' => '',
        ],
        'test' => [
            'rollbar_access_token' => '',
        ],
        'staging' => [
            'rollbar_access_token' => '',
        ],
        'production' => [
            'rollbar_access_token' => '',
        ]
    ]
];
