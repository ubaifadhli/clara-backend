<?php
    return [
        'default' => 'mongodb',
        'connections' => [
            'mongodb' => [
                'driver' => 'mongodb',
                'dsn'=>'mongodb+srv://ubai_admin:gVh784U3a7!3@cluster0.nvfrn.mongodb.net/?retryWrites=true&w=majority',
                'database' => 'line_bot_data',
            ]   
        ],
        'migrations' => 'migrations',
    ];

?>