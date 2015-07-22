<?php
namespace BlogServices\Asset;

class AssetEntity
{
    /**
     * Unique id of blog post asset
     *
     * @var int
     */
    protected $id;

    /**
     * Id of blog post associated with asset
     *
     * @var int
     */
    protected $blogPostId;

    /**
     * The base url relative to document root where asset can be downloaded
     *
     * @var string
     */
    protected $baseurl;

    /**
     * The base directory relative to project directory where asset is stored
     *
     * @var string
     */
    protected $directory;

    /**
     * The file name of the asset
     *
     * @var string
     */
    protected $filename;

    /**
     * @return int
     */
    public function getBlogPostId()
    {
        return $this->blogPostId;
    }

    /**
     * @param int $blogPostId
     */
    public function setBlogPostId($blogPostId)
    {
        $this->blogPostId = $blogPostId;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @param string $filename
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;
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
    public function getBaseurl()
    {
        return $this->baseurl;
    }

    /**
     * @param string $baseurl
     */
    public function setBaseurl($baseurl)
    {
        $this->baseurl = $baseurl;
    }
}
