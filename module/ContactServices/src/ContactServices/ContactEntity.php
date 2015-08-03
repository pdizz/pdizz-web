<?php

namespace ContactServices;

class ContactEntity
{
    /**
     * Unique identifier for contact request
     *
     * @var int
     */
    protected $id;

    /**
     * Name of person contacting
     *
     * @var string
     */
    protected $name;

    /**
     * Email address of contact
     *
     * @var string
     */
    protected $email;

    /**
     * Contact message
     *
     * @var string
     */
    protected $message;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }
}
