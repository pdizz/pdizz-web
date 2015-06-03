<?php

use Sql\SqlService;
use Sql\SqlServiceFactory;

return [
    'service_manager' => [
        'factories' => [
            SqlService::class => SqlServiceFactory::class
        ]
    ]
];
