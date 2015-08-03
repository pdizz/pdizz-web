<?php

namespace ContactServices\Listener;

use Email\EmailService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ContactEmailListenerFactory implements FactoryInterface
{
    /**
     * Inject email service and configuration into email notification listener
     *
     * @param ServiceLocatorInterface $services
     * @return ContactEmailListener
     */
    public function createService(ServiceLocatorInterface $services)
    {
        $listener = new ContactEmailListener();
        $listener->setConfig($services->get('Config'));
        $listener->setEmailService($services->get(EmailService::class));
        return $listener;
    }
}