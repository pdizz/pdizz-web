<?php
namespace BlogApi\V1\Rest\Post;

use BlogServices\Post\PostEntity;
use BlogServices\Post\PostService;
use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;
use Zend\Stdlib\Hydrator\HydratorInterface;

class PostResource extends AbstractResourceListener
{
    /**
     * @var PostService
     */
    protected $postService;

    /**
     * @var HydratorInterface
     */
    protected $postHydrator;

    /**
     * Create a resource
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function create($data)
    {
        $data = $this->getInputFilter()->getValues();
        $post = $this->getPostHydrator()->hydrate($data, new PostEntity());

        return $this->getPostService()->createPost($post);
    }

    /**
     * Delete a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function delete($id)
    {
        return new ApiProblem(405, 'The DELETE method has not been defined for individual resources');
    }

    /**
     * Fetch a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function fetch($id)
    {
        return $this->getPostService()->fetchById($id);
    }

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = array())
    {
        return $this->getPostService()->fetchList((array) $params);
    }

    /**
     * Patch (partial in-place update) a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patch($id, $data)
    {
        $data    = $this->getInputFilter()->getValues();
        $current = $this->getPostService()->fetchById($id);

        // Hydrate new data over old post to patch it
        $post = $this->getPostHydrator()->hydrate($data, $current);

        return $this->getPostService()->updatePost($id, $post);
    }

    /**
     * Update a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function update($id, $data)
    {
        $data = $this->getInputFilter()->getValues();
        $post = $this->getPostHydrator()->hydrate($data, new PostEntity());

        return $this->getPostService()->updatePost($id, $post);
    }

    /**
     * @return PostService
     */
    public function getPostService()
    {
        return $this->postService;
    }

    /**
     * @param PostService $postService
     */
    public function setPostService(PostService $postService)
    {
        $this->postService = $postService;
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
