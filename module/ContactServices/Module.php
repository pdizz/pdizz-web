<?php

namespace ContactServices;

use ContactServices\Listener\ContactEmailListener;
use Zend\Mvc\MvcEvent;

class Module
{
    /**
     * Attach contact listeners
     *
     * @param MvcEvent $event
     */
    public function onBootstrap(MvcEvent $event)
    {
        $listener = $event->getApplication()->getServiceManager()->get(ContactEmailListener::class);

        $event->getApplication()->getEventManager()->getSharedManager()->attach(
            ContactService::class,
            'contact',
            [$listener, 'notify']
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}
