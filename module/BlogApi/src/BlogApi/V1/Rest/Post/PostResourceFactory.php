<?php
namespace BlogApi\V1\Rest\Post;

use BlogServices\Post\PostService;
use Zend\Stdlib\Hydrator\ClassMethods;

class PostResourceFactory
{
    public function __invoke($services)
    {
        $controller = new PostResource();
        $controller->setPostService($services->get(PostService::class));
        $controller->setPostHydrator(new ClassMethods());
        return $controller;
    }
}
