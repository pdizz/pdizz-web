<?php

namespace BlogServices\Post;

use Sql\SqlService;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\TableIdentifier;
use Zend\Db\Sql\Update;
use Zend\Paginator\Adapter\DbSelect;
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
        $select = $this->selectById($postId);
        $result = $this->getSqlService()->fetchRow($select);

        if (!$result) {
            throw new \DomainException('The specified blog post does not exist.', 404);
        }

        return $this->getPostHydrator()->hydrate($result, new PostEntity());
    }

    public function fetchList(array $filters = [])
    {
        $select  = $this->selectWithFilters($filters);
        return new PostCollection(
            new DbSelect($select, $this->getSqlService()->getDbAdapter())
        );
    }

    public function createPost(PostEntity $post)
    {
        $insert = $this->getPostInsert($post);
        $this->getSqlService()->execute($insert);

        return $this->fetchById($this->getSqlService()->getLastInsertId());
    }

    public function updatePost($id, PostEntity $post)
    {
        $post->setId($id);
        $update = $this->getPostUpdate($post);
        $this->getSqlService()->execute($update);

        return $this->fetchById($id);
    }

    protected function selectPosts()
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

    protected function selectById($postId)
    {
        $select = $this->selectPosts()
            ->where(['blog_post_id' => $postId]);

        return $select;
    }

    protected function selectWithFilters(array $filters)
    {
        $select = $this->selectPosts();

        if (isset($filters['is_visible'])) {
            $select->where(['is_visible' => (bool) $filters['is_visible']]);
        }

        return $select;
    }

    protected function getPostInsert(PostEntity $post)
    {
        $insert = new Insert();
        $insert->into(new TableIdentifier('blog_post'))
            ->values([
                'content' => $post->getContent(),
                'is_visible' => $post->getIsVisible()
            ]);

        return $insert;
    }

    protected function getPostUpdate(PostEntity $post)
    {
        $update = new Update();
        $update->table(new TableIdentifier('blog_post'))
            ->set([
                'content' => $post->getContent(),
                'is_visible' => $post->getIsVisible()
            ])
            ->where(['blog_post_id' => $post->getId()]);

        return $update;
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