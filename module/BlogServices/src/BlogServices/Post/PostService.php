<?php

namespace BlogServices\Post;

use Sql\SqlService;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\TableIdentifier;
use Zend\Stdlib\Hydrator\HydratorInterface;

class PostService
{
    /**
     * @var SqlService
     */
    protected $sqlService;

    /**
     * @var HydratorInterface
     */
    protected $postHydrator;

    public function fetchById($postId)
    {
        $select = $this->getPostSelect();
        $select->where(['blog_post_id' => $postId]);

        $result = $this->getSqlService()->fetchRow($select);
        return $this->getPostHydrator()->hydrate($result, new PostEntity());
    }

    protected function getPostSelect()
    {
        $select = new Select();
        $select->from(new TableIdentifier('blog_post'))
            ->columns([
                'id' => 'blog_post_id',
                'content',
                'is_visible',
                'created_timestamp'
            ]);

        return $select;
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
    public function setSqlService(SqlService $sqlService)
    {
        $this->sqlService = $sqlService;
    }

    /**
     * @return HydratorInterface
     */
    public function getPostHydrator()
    {
        return $this->postHydrator;
    }

    /**
     * @param HydratorInterface $postHydrator
     */
    public function setPostHydrator(HydratorInterface $postHydrator)
    {
        $this->postHydrator = $postHydrator;
    }
}