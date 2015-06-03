<?php

namespace Pdizz\DbAdapter;

use Zend\Db\Adapter\Adapter;

trait AdapterAwareTrait
{
    /**
     * @var Adapter
     */
    protected $dbAdapter;

    /**
     * @return Adapter
     */
    public function getDbAdapter()
    {
        return $this->dbAdapter;
    }

    /**
     * @param Adapter $dbAdapter
     */
    public function setDbAdapter(Adapter $dbAdapter)
    {
        $this->dbAdapter = $dbAdapter;
    }
}