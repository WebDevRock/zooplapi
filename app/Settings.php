<?php
return [
    'settings' => [
        'displayErrorDetails' => true,

        // App
        'app' => [
            'env' => 'dev',
            'key' => '?0x1nh@f0lg@t0',
        ],

        // Database
        'database' => [
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => 'zooplapi',
            'username'  => 'root',
            'password'  => '',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ],

        // Router
        'router' => [
            'public' => [
                '/public',
            ]
        ],

        // Zoopla
        'zoopla' => [
            'api_key' => 'wxg8jtyuybwq2ydqu4xuejw5'
        ]
    ],
];