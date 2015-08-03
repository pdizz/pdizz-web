<?php

use Email\EmailService;
use Email\EmailServiceFactory;

return [
    'service_manager' => [
        'factories' => [
            EmailService::class => EmailServiceFactory::class
        ]
    ]
];
