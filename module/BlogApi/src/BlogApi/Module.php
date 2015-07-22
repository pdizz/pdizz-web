<?php
namespace BlogApi;

use BlogApi\V1\Rest\Asset\AssetHalListener;
use ZF\Apigility\Provider\ApigilityProviderInterface;
use Zend\Mvc\MvcEvent;

class Module implements ApigilityProviderInterface
{
    /**
     * Attach listener to add HAL link for file download URL
     *
     * @param MvcEvent $e
     */
    public function onBootstrap(MvcEvent $e)
    {
        $request = $e->getRequest();
        if (!$request instanceof \Zf\ContentNegotiation\Request) {
            return;
        }

        $routeMatch = $e->getRouter()->match($request);
        if (!$routeMatch) {
            return;
        }

        $routeName = $routeMatch->getMatchedRouteName();
        if ($routeName !== 'blog-api.rest.asset') {
            return;
        }

        $services = $e->getTarget()->getServiceManager();
        $hal      = $services->get('ViewHelperManager')->get('Hal');
        $listener = $services->get(AssetHalListener::class);

        $hal->getEventManager()->attach(
            'renderEntity',
            array($listener, 'attachAssetLink')
        );
        $hal->getEventManager()->attach(
            'renderCollection.post',
            array($listener, 'attachAssetLinkCollection')
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/../../config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'ZF\Apigility\Autoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__,
                ),
            ),
        );
    }
}
