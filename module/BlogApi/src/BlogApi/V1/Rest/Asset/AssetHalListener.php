<?php

namespace BlogApi\V1\Rest\Asset;

use Zend\EventManager\Event;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use ZF\Hal\Link\Link as HalLink;

class AssetHalListener implements ServiceLocatorAwareInterface
{
    /**
     * Accessors for service locator
     */
    use ServiceLocatorAwareTrait;

    /**
     * Attach download link to asset HAL metadata
     *
     * @param Event $event
     */
    public function attachAssetLink(Event $event)
    {
        $halEntity = $event->getParam('entity');

        $uri  = $this->getServiceLocator()->get('Router')->getRequestUri();
        $link = new HalLink('download');

        $link->setUrl(
            $uri->getScheme() . '://' . $uri->getHost()
            . '/' . $halEntity->entity->getBaseurl()
            . '/' . $halEntity->entity->getFilename());

        $halEntity->getLinks()->add($link);
    }
}