<?php

namespace BlogServices\Post;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Stdlib\Hydrator\Strategy\BooleanStrategy;
use Sql\SqlService;

class PostServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $services)
    {
        $service = new PostService();
        $service->setSqlService($services->get(SqlService::class));

        $hydrator = new ClassMethods();
        // Stupid MySQL...
        $hydrator->addStrategy('is_visible', new BooleanStrategy("1", "0"));
        $service->setPostHydrator($hydrator);

        return $service;
    }
}