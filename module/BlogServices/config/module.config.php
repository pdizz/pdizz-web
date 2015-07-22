<?php

use BlogServices\Post\PostService;
use BlogServices\Post\PostServiceFactory;
use BlogServices\Asset\AssetService;
use BlogServices\Asset\AssetServiceFactory;

return [
    'service_manager' => [
        'factories' => [
            PostService::class => PostServiceFactory::class,
            AssetService::class => AssetServiceFactory::class
        ]
    ]
];
