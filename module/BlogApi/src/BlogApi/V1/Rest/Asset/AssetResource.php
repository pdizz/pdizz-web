<?php
namespace BlogApi\V1\Rest\Asset;

use BlogServices\Asset\AssetEntity;
use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;
use BlogServices\Asset\AssetService;
use Zend\Stdlib\Hydrator\HydrationInterface;

class AssetResource extends AbstractResourceListener
{
    /**
     * @var AssetService
     */
    protected $assetService;

    /**
     * @var HydrationInterface
     */
    protected $uploadHydrator;

    /**
     * @var array
     */
    protected $config;

    /**
     * Create a resource
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function create($data)
    {
        $config = $this->getConfig();
        $data   = $this->getInputFilter()->getValues();

        $asset = $this->getUploadHydrator()->hydrate(
            array_merge($config, $data),
            new AssetEntity()
        );

        return $this->getAssetService()->createAssetFromTempFile(
            $data['file']['tmp_name'],
            $asset
        );
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
        return $this->getAssetService()->fetchById($id);
    }

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = array())
    {
        return $this->getAssetService()->fetchList((array) $params);
    }

    /**
     * @return AssetService
     */
    public function getAssetService()
    {
        return $this->assetService;
    }

    /**
     * @param AssetService $assetService
     */
    public function setAssetService(AssetService $assetService)
    {
        $this->assetService = $assetService;
    }

    /**
     * @return HydrationInterface
     */
    public function getUploadHydrator()
    {
        return $this->uploadHydrator;
    }

    /**
     * @param HydrationInterface $uploadHydrator
     */
    public function setUploadHydrator(HydrationInterface $uploadHydrator)
    {
        $this->uploadHydrator = $uploadHydrator;
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param array $config
     */
    public function setConfig(array $config)
    {
        $this->config = $config;
    }
}
