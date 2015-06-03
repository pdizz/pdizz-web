<?php

namespace BlogServices\Post;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\ClassMethods;
use Sql\SqlService;

class PostServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $services)
    {
        $service = new PostService();
        $service->setSqlService($services->get(SqlService::class));
        $service->setPostHydrator(new ClassMethods());
        return $service;
    }
}