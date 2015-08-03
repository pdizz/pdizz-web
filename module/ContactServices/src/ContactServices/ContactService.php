<?php

namespace ContactServices;

use Sql\SqlService;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Select;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerAwareTrait;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Stdlib\Hydrator\HydratorInterface;

class ContactService implements EventManagerAwareInterface
{
    /**
     * Accessors for EventManagerAwareInterface
     */
    use EventManagerAwareTrait;

    /**
     * @var SqlService
     */
    protected $sqlService;

    /**
     * @var HydratorInterface
     */
    protected $hydrator;

    /**
     * Insert a record of the contact request and notify listeners
     *
     * @param ContactEntity $contact
     * @return ContactEntity
     */
    public function contact(ContactEntity $contact)
    {
        $insert = $this->contactInsert($contact);
        $this->getSqlService()->execute($insert);
        $contact = $this->fetchContact($this->getSqlService()->getLastInsertId());

        // Notify listeners
        $this->getEventManager()->trigger('contact', $this, $contact);

        return $contact;
    }

    /**
     * Fetch a contact request record by its id
     *
     * @param $id
     * @return ContactEntity
     */
    public function fetchContact($id)
    {
        $select = $this->selectById($id);
        $result = $this->getSqlService()->fetchRow($select);

        return $this->getHydrator()->hydrate($result, new ContactEntity());
    }

    /**
     * Fetch list of contact requests
     *
     * @return ContactCollection
     */
    public function fetchContactList()
    {
        $select = $this->selectContacts();
        return new ContactCollection(
            new DbSelect($select, $this->getSqlService()->getDbAdapter())
        );
    }

    /**
     * Create a sql object to fetch list of contact requests
     *
     * @return Select
     */
    protected function selectContacts()
    {
        $select = new Select();
        $select->from('contact_request')
            ->columns([
                'id' => 'contact_request_id',
                'name',
                'email',
                'message',
                'created_timestamp'
            ]);
        return $select;
    }

    /**
     * Filter contact list to single record by id
     *
     * @param $id
     * @return Select
     */
    protected function selectById($id)
    {
        $select = $this->selectContacts()
            ->where(['contact_request_id' => $id]);
        return $select;
    }

    /**
     * Build a sql object to insert a contact request record
     *
     * @param ContactEntity $contact
     * @return Insert
     */
    protected function contactInsert(ContactEntity $contact)
    {
        $insert = new Insert();
        $insert->into('contact_request')
            ->values([
                'name' => $contact->getName(),
                'email' => $contact->getEmail(),
                'message' => $contact->getMessage()
            ]);
        return $insert;
    }

    /**
     * @return SqlService
     */
    public function getSqlService()
    {
        return $this->sqlService;
    }

    /**
     * @param SqlService $sqlService
     */
    public function setSqlService($sqlService)
    {
        $this->sqlService = $sqlService;
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