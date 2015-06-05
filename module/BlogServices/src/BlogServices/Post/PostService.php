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

    /**
     * Fetch an individual blog post by it's unique id
     *
     * @param $postId
     * @return PostEntity
     */
    public function fetchById($postId)
    {
        $select = $this->selectById($postId);
        $result = $this->getSqlService()->fetchRow($select);

        if (!$result) {
            throw new \DomainException('The specified blog post does not exist.', 404);
        }

        return $this->getPostHydrator()->hydrate($result, new PostEntity());
    }

    /**
     * Fetch a filtered collection of blog posts
     *
     * Filters:
     * * is_visible
     *
     * @param array $filters
     * @return PostCollection
     */
    public function fetchList(array $filters = [])
    {
        $select  = $this->selectWithFilters($filters);
        return new PostCollection(
            new DbSelect($select, $this->getSqlService()->getDbAdapter())
        );
    }

    /**
     * Create a new blog post record
     *
     * @param PostEntity $post
     * @return PostEntity
     */
    public function createPost(PostEntity $post)
    {
        $insert = $this->getPostInsert($post);
        $this->getSqlService()->execute($insert);

        return $this->fetchById($this->getSqlService()->getLastInsertId());
    }

    /**
     * Update an existing blog post record
     *
     * @param $id
     * @param PostEntity $post
     * @return PostEntity
     */
    public function updatePost($id, PostEntity $post)
    {
        $update = $this->getPostUpdate($id, $post);
        $this->getSqlService()->execute($update);

        return $this->fetchById($id);
    }

    /**
     * Get a sql object to fetch all blog posts
     *
     * @return Select
     */
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

    /**
     * Get a sql object to fetch a specific blog post by id
     *
     * @param $postId
     * @return Select
     */
    protected function selectById($postId)
    {
        $select = $this->selectPosts()
            ->where(['blog_post_id' => $postId]);

        return $select;
    }

    /**
     * Get a sql object to fetch a filtered list of blog posts
     *
     * @param array $filters
     * @return Select
     */
    protected function selectWithFilters(array $filters)
    {
        $select = $this->selectPosts();

        if (isset($filters['is_visible'])) {
            $select->where(['is_visible' => (bool) $filters['is_visible']]);
        }

        return $select;
    }

    /**
     * Get a sql object to insert a new blog post
     *
     * @param PostEntity $post
     * @return Insert
     */
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

    /**
     * Get a sql object to update an existing blog post
     *
     * @param int $id
     * @param PostEntity $post
     * @return Update
     */
    protected function getPostUpdate($id, PostEntity $post)
    {
        $update = new Update();
        $update->table(new TableIdentifier('blog_post'))
            ->set([
                'content' => $post->getContent(),
                'is_visible' => $post->getIsVisible()
            ])
            ->where(['blog_post_id' => $id]);

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