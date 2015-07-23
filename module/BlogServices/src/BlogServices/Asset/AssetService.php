<?php

namespace BlogServices\Asset;

use Sql\SqlService;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\TableIdentifier;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Stdlib\Hydrator\HydratorInterface;

class AssetService
{
    /**
     * @var SqlService
     */
    protected $sqlService;

    /**
     * @var HydratorInterface
     */
    protected $assetHydrator;

    /**
     * @var string
     */
    protected $directory;

    /**
     * @var string
     */
    protected $url;

    /**
     * Create the asset record associated to the blog post and save the uploaded file
     *
     * @param $temp
     * @param AssetEntity $asset
     * @return AssetEntity
     * @throws \Exception
     */
    public function createAssetFromTempFile($temp, AssetEntity $asset)
    {
        $sqlService = $this->getSqlService();
        $sqlService->beginTransaction();

        // Insert db record for asset
        $insert = $this->assetInsert($asset);
        try {
            $sqlService->execute($insert);
        } catch (\Exception $e) {
            // Foreign key violation, blog post doesn't exist
            if ($e->getPrevious()->getCode() == 23000) {
                throw new \Exception('Failed creating asset, blog post does not exist.');
            }
            throw $e;
        }

        // Save file to destination
        try {
            $destination = $asset->getDirectory() . '/' . $asset->getFilename();
            $success = move_uploaded_file($temp, $destination);
        } catch (\Exception $e) {
            $sqlService->rollback();
            throw new \Exception('Unable to save uploaded file');
        }

        if (!$success) {
            $sqlService->rollback();
            throw new \Exception('Unable to save uploaded file');
        }

        // Have to do this before committing transaction or it just returns 0
        $asset->setId($sqlService->getLastInsertId());

        $sqlService->commit();
        return $asset;
    }

    /**
     * Fetch a list of blog post assets optionally filtered on blog_post_id
     *
     * @param array $filters
     * @return AssetCollection
     */
    public function fetchList(array $filters = [])
    {
        $select = $this->selectWithFilters($filters);

        $resultSetPrototype = new HydratingResultSet(
            $this->getAssetHydrator(),
            new AssetEntity()
        );

        return new AssetCollection(
            new DbSelect($select, $this->getSqlService()->getDbAdapter(), $resultSetPrototype)
        );
    }

    /**
     * Fetch a single asset by its unique id
     *
     * @param $blogAssetId
     * @return AssetEntity
     */
    public function fetchById($blogAssetId)
    {
        $select = $this->selectById($blogAssetId);
        $result = $this->getSqlService()->fetchRow($select);

        return $this->getAssetHydrator()->hydrate($result, new AssetEntity());
    }

    /**
     * Build a sql object to fetch all blog post assets
     *
     * @return Select
     */
    protected function selectAssets()
    {
        $select = new Select();
        $select->from(new TableIdentifier('blog_asset'))
            ->columns([
                'id' => 'blog_asset_id',
                'blog_post_id',
                'baseurl',
                'filename'
            ]);

        return $select;
    }

    /**
     * Build a sql object to fetch blog post assets filtering on blog_post_id
     *
     * @param array $filters
     * @return Select
     */
    protected function selectWithFilters(array $filters)
    {
        $select = $this->selectAssets();

        if (isset($filters['blog_post_id'])) {
            $select->where(['blog_post_id' => $filters['blog_post_id']]);
        }

        return $select;
    }

    /**
     * Build a sql object to fetch a single blog post asset by its unique id
     *
     * @param $blogAssetId
     * @return Select
     */
    protected function selectById($blogAssetId)
    {
        $select = $this->selectAssets()->where(['blog_asset_id' => $blogAssetId]);
        return $select;
    }

    /**
     * Build a sql object to insert a new blog post asset
     *
     * @param AssetEntity $asset
     * @return Insert
     */
    protected function assetInsert(AssetEntity $asset)
    {
        $insert = new Insert();
        $insert->into(new TableIdentifier('blog_asset'))
            ->values([
                'blog_post_id' => $asset->getBlogPostId(),
                'directory' => $asset->getDirectory(),
                'baseurl' => $asset->getBaseurl(),
                'filename' => $asset->getFilename()
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
    public function setSqlService(SqlService $sqlService)
    {
        $this->sqlService = $sqlService;
    }

    /**
     * @return HydratorInterface
     */
    public function getAssetHydrator()
    {
        return $this->assetHydrator;
    }

    /**
     * @param HydratorInterface $assetHydrator
     */
    public function setAssetHydrator(HydratorInterface $assetHydrator)
    {
        $this->assetHydrator = $assetHydrator;
    }

    /**
     * @return string
     */
    public function getDirectory()
    {
        return $this->directory;
    }

    /**
     * @param string $directory
     */
    public function setDirectory($directory)
    {
        $this->directory = $directory;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }
}