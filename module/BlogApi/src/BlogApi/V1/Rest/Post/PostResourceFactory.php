<?php
namespace BlogApi\V1\Rest\Post;

use BlogServices\Post\PostService;

class PostResourceFactory
{
    public function __invoke($services)
    {
        $controller = new PostResource();
        $controller->setPostService($services->get(PostService::class));
        return $controller;
    }
}
