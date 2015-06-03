<?php

use BlogServices\Post\PostService;
use BlogServices\Post\PostServiceFactory;

return [
    'service_manager' => [
        'factories' => [
            PostService::class => PostServiceFactory::class
        ]
    ]
];
