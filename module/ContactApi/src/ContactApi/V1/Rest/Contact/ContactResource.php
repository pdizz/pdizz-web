<?php
namespace ContactApi\V1\Rest\Contact;

use ContactServices\ContactEntity;
use ContactServices\ContactService;
use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;
use Zend\Stdlib\Hydrator\HydratorInterface;

class ContactResource extends AbstractResourceListener
{
    /**
     * @var ContactService
     */
    protected $contactService;

    /**
     * @var HydratorInterface
     */
    protected $hydrator;

    /**
     * Create a resource
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function create($data)
    {
        $data    = $this->getInputFilter()->getValues();
        $contact = $this->getHydrator()->hydrate($data, new ContactEntity());

        return $this->getContactService()->contact($contact);
    }

    /**
     * Fetch a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function fetch($id)
    {
        return $this->getContactService()->fetchContact($id);
    }

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = array())
    {
        return $this->getContactService()->fetchContactList();
    }

    /**
     * @return ContactService
     */
    public function getContactService()
    {
        return $this->contactService;
    }

    /**
     * @param ContactService $contactService
     */
    public function setContactService($contactService)
    {
        $this->contactService = $contactService;
    }

    /**
     * @return HydratorInterface
     */
    public function getHydrator()
    {
        return $this->hydrator;
    }

    /**
     * @param HydratorInterface $hydrator
     */
    public function setHydrator($hydrator)
    {
        $this->hydrator = $hydrator;
    }
}
