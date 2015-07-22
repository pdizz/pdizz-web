<?php

namespace BlogApi\V1\Rest\Asset;

use Zend\Stdlib\Hydrator\HydrationInterface;

class AssetUploadHydrator implements HydrationInterface
{
    public function hydrate(array $data, $object)
    {
        $filename = preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $data['file']['name']);
        $object->setFilename(uniqid() . '_' . $filename);
        $object->setBlogPostId($data['blog_post_id']);
        $object->setDirectory($data['basepath']);
        $object->setBaseurl($data['baseurl']);
        return $object;
    }
}