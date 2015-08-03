<?php

namespace ContactApi\V1\Rest\Contact;

use ContactServices\ContactService;
use Zend\Stdlib\Hydrator\ClassMethods;

class ContactResourceFactory
{
    public function __invoke($services)
    {
        $controller = new ContactResource();
        $controller->setContactService($services->get(ContactService::class));
        $controller->setHydrator(new ClassMethods());
        return $controller;
    }
}
