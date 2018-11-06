<?php
return [
    'settings' => [
        'displayErrorDetails' => getenv('app_debug', false),

        // Database
        'database' => [
            'driver'    => 'mysql',
            'host'      => getenv('db_host', 'localhost'),
            'database'  => getenv('db_name', 'zooplapi'),
            'username'  => getenv('db_username', 'root'),
            'password'  => getenv('db_password', ''),
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
    ],
];