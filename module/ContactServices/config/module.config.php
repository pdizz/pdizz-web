<?php

use ContactServices\ContactService;
use ContactServices\ContactServiceFactory;
use ContactServices\Listener\ContactEmailListener;
use ContactServices\Listener\ContactEmailListenerFactory;

return [
    'service_manager' => [
        'factories' => [
            ContactService::class => ContactServiceFactory::class,
            ContactEmailListener::class => ContactEmailListenerFactory::class
        ]
    ]
];
