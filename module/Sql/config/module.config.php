<?php

use Pdizz\Sql\SqlService;
use Pdizz\Sql\SqlServiceFactory;

return [
    'service_manager' => [
        'factories' => [
            SqlService::class => SqlServiceFactory::class
        ]
    ]
];
