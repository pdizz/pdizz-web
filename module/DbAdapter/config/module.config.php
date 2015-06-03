<?php

use Pdizz\DbAdapter\AdapterFactory;

return [
    'service_manager' => [
        'factories' => [
            'DbAdapter' => AdapterFactory::class
        ]
    ]
];
