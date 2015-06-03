<?php

namespace Pdizz\DbAdapter;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Db\Adapter\Adapter;

class AdapterFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config   = $serviceLocator->get('Config');
        $dbConfig = $config['mysql'];

        return new Adapter($dbConfig);
    }
}