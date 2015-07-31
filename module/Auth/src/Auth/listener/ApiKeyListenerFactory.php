<?php

namespace Auth\Listener;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ApiKeyListenerFactory implements FactoryInterface
{
    /**
     * Inject dependencies into the API key authentication listener
     *
     * @param ServiceLocatorInterface $services
     * @return ApiKeyListener
     */
    public function createService(ServiceLocatorInterface $services)
    {
        $listener = new ApiKeyListener();
        $listener->setConfig($services->get('Config'));
        return $listener;
    }
}