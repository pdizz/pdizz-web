<?php

namespace Sql;

use DbAdapter\AdapterAwareTrait;

use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\AdapterAwareInterface;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\SqlInterface;

class SqlService implements AdapterAwareInterface
{
    /**
     * Required methods for AdapterAwareInterface
     */
    use AdapterAwareTrait;

    /**
     * @var Sql
     */
    protected $sqlAdapter;

    protected function getSqlAdapter()
    {
        if (null === $this->sqlAdapter) {
            $this->sqlAdapter = new Sql($this->getDbAdapter());
        }
        return $this->sqlAdapter;
    }

    public function execute(SqlInterface $sql)
    {
        return $this->getSqlAdapter()
            ->prepareStatementForSqlObject($sql)
            ->execute();
    }

    public function query(SqlInterface $sql)
    {
        $selectString = $this->getSqlAdapter()->buildSqlString($sql);
        return $this->dbAdapter
            ->query($selectString, Adapter::QUERY_MODE_EXECUTE);
    }

    public function prepare(SqlInterface $sql)
    {
        $selectString = $this->getSqlAdapter()->buildSqlString($sql);
        return $this->dbAdapter
            ->query($selectString, Adapter::QUERY_MODE_PREPARE);
    }

    public function fetchAll(Select $select)
    {
        $selectString = $this->getSqlAdapter()->buildSqlString($select);
        return $this->dbAdapter
            ->query($selectString, Adapter::QUERY_MODE_EXECUTE)
            ->toArray();
    }

    public function fetchRow(Select $select)
    {
        return $this->execute($select)->current();
    }

    public function count(Select $select)
    {
        // Reset limit and offset so we will get a count of all results
        $tempSelect = $select;
        $tempSelect->reset(Select::LIMIT)
            ->reset(Select::OFFSET);

        $statement = $this->getSqlAdapter()
            ->prepareStatementForSqlObject($tempSelect);
        return $statement->execute()->count();
    }

    public function getLastInsertId($sequence = null)
    {
        $id = $this->getDbAdapter()
            ->getDriver()
            ->getConnection()
            ->getLastGeneratedValue($sequence);
        return $id;
    }

    public function beginTransaction()
    {
        return $this->getDbAdapter()
            ->getDriver()
            ->getConnection()
            ->beginTransaction();
    }

    public function rollback()
    {
        return $this->getDbAdapter()
            ->getDriver()
            ->getConnection()
            ->rollback();
    }

    public function commit()
    {
        return $this->getDbAdapter()
            ->getDriver()
            ->getConnection()
            ->commit();
    }
}