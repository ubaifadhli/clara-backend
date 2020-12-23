<?php
    return [
        'default' => 'mongodb',
        'connections' => [
            'mongodb' => [
                'driver' => 'mongodb',
                'dsn'=>env('DB_DSN', ''),
                'database' => env('DB_DATABASE', ''),
                'options' => [
                    'tls' => true,
                ],
            ],   
        ],
        'migrations' => 'migrations',
    ];

?>
