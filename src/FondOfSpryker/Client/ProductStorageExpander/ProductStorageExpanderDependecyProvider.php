<?php

namespace FondOfSpryker\Client\ProductStorageExpander;

use FondOfSpryker\Client\ProductStorageExpander\Dependency\Client\ProductStorageExpanderToProductPageSearchExpanderClientBridge;
use Spryker\Client\Kernel\AbstractDependencyProvider;
use Spryker\Client\Kernel\Container;

class ProductStorageExpanderDependecyProvider extends AbstractDependencyProvider
{
    public const CLIENT_PRODUCT_PAGE_SEARCH_EXPANDER = 'CLIENT_PRODUCT_PAGE_SEARCH_EXPANDER';

    /**
     * @param Container $container
     *
     * @return Container
     */
    public function provideServiceLayerDependencies(Container $container): Container
    {
        $container = $this->addProductPageSearchExpanderClient($container);

        return $container;
    }

    /**
     * @param Container $container
     *
     * @return Container
     */
    protected function addProductPageSearchExpanderClient(Container $container): Container
    {
        $container[static::CLIENT_PRODUCT_PAGE_SEARCH_EXPANDER] = function (Container $container) {
            return new ProductStorageExpanderToProductPageSearchExpanderClientBridge(
                $container->getLocator()->productPageSearchExpanderClient()->client()
            );
        };

        return $container;
    }
}
