<?php
namespace BlogApi\V1\Rest\Asset;

use BlogServices\Asset\AssetService;

class AssetResourceFactory
{
    public function __invoke($services)
    {
        $controller = new AssetResource();
        $controller->setAssetService($services->get(AssetService::class));
        $controller->setConfig($services->get('Config')['blog']['asset']);
        $controller->setUploadHydrator(new AssetUploadHydrator());
        return $controller;
    }
}
