<?php

namespace Email;

use Zend\Mail\Transport\Factory;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class EmailServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $services)
    {
        $service = new EmailService();

        $config = $services->get('Config');
        $transport = Factory::create($config['email']);
        $service->setTransport($transport);

        return $service;
    }
}