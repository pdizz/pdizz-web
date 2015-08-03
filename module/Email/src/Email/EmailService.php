<?php

namespace Email;

use Zend\Mail\Message;
use Zend\Mail\Transport\TransportInterface;

class EmailService
{
    /**
     * @var TransportInterface
     */
    protected $transport;

    public function send(Message $message)
    {
        $this->getTransport()->send($message);
    }

    /**
     * @return TransportInterface
     */
    public function getTransport()
    {
        return $this->transport;
    }

    /**
     * @param TransportInterface $transport
     */
    public function setTransport(TransportInterface $transport)
    {
        $this->transport = $transport;
    }
}