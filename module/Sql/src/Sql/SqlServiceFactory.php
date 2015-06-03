<?php

namespace Sql;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class SqlServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $services)
    {
        $service = new SqlService();
        $service->setDbAdapter($services->get('DbAdapter'));
        return $service;
    }
}