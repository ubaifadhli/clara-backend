<?php
    return [
        'default' => 'mongodb',
        'connections' => [
            'mongodb' => [
                'driver' => 'mongodb',
                'dsn'=>env('DB_DSN', 'mongodb+srv://ubai_admin:gVh784U3a7!3@cluster0.nvfrn.mongodb.net/?retryWrites=true&w=majority'),
                'database' => env('DB_DATABASE', 'clara'),
                'options' => [
                    'tls' => true,
                ],
            ],   
        ],
        'migrations' => 'migrations',
    ];

?>