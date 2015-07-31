<?php

use Auth\Listener\ApiKeyListener;
use Auth\Listener\ApiKeyListenerFactory;

return [
    'service_manager' => [
        'factories' => [
            ApiKeyListener::class => ApiKeyListenerFactory::class
        ]
    ]
];
