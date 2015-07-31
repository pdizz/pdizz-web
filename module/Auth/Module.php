<?php

namespace Auth;

use Auth\Listener\ApiKeyListener;
use Zend\Mvc\MvcEvent;
use ZF\MvcAuth\MvcAuthEvent;

class Module
{
    /**
     * Attach authentication event listeners
     *
     * @param MvcEvent $event
     */
    public function onBootstrap(MvcEvent $event)
    {
        $shared   = $event->getApplication()->getEventManager()->getSharedManager();
        $services = $event->getApplication()->getServiceManager();
        $listener = $services->get(ApiKeyListener::class);

        $shared->attach(
            'Zend\Mvc\Application',
            MvcAuthEvent::EVENT_AUTHENTICATION,
            [$listener, 'authenticate'],
            1000
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
