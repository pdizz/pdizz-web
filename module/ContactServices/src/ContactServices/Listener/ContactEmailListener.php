<?php

namespace ContactServices\Listener;

use ContactServices\ContactEntity;
use Email\EmailService;
use Zend\EventManager\EventInterface;
use Zend\Mail\Address;
use Zend\Mail\Message;

class ContactEmailListener
{
    /**
     * @var array
     */
    protected $config;

    /**
     * @var EmailService
     */
    protected $emailService;

    /**
     * Send email notification of contact request
     *
     * @param EventInterface $event
     */
    public function notify(EventInterface $event)
    {
        $contact = $event->getParams();
        if (!$contact instanceof ContactEntity) {
            return;
        }

        $config  = $this->getConfig();
        $message = new Message();
        $message->setFrom($config['contact']['from']);
        $message->setTo($config['contact']['email']);
        $message->setSubject("Contact Request from {$contact->getName()}");
        $message->setBody(
            "Contact request ID {$contact->getId()}\n" .
            "Name: {$contact->getName()}\n" .
            "Email: {$contact->getEmail()}\n" .
            "\n---------------------------------\n" .
            $contact->getMessage()
        );

//        try {
            $this->getEmailService()->send($message);
//        } catch (\Exception $e) {
//            // TODO log failure
//        }
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

    /**
     * @return EmailService
     */
    public function getEmailService()
    {
        return $this->emailService;
    }

    /**
     * @param EmailService $emailService
     */
    public function setEmailService($emailService)
    {
        $this->emailService = $emailService;
    }
}