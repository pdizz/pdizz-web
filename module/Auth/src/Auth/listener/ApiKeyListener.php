<?php

namespace Auth\Listener;

use ZF\MvcAuth\Identity\AuthenticatedIdentity;
use ZF\MvcAuth\Identity\GuestIdentity;
use ZF\MvcAuth\MvcAuthEvent;

class ApiKeyListener
{
    /**
     * Store the application config
     *
     * @var array
     */
    protected $config;

    /**
     * Authenticate against an API token sent in request headers
     *
     * @param MvcAuthEvent $event
     * @return AuthenticatedIdentity|GuestIdentity
     */
    public function authenticate(MvcAuthEvent $event)
    {
        $header = $event->getMvcEvent()->getRequest()->getHeaders()->get('Api-Key');
        $token  = $this->getConfig()['api']['token'];

        if (!$header || $header->getFieldValue() !== $token) {
            return new GuestIdentity();
        }

        return new AuthenticatedIdentity('admin');
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param array $config
     */
    public function setConfig($config)
    {
        $this->config = $config;
    }
}