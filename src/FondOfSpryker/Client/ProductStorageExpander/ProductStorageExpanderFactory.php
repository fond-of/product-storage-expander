<?php

namespace FondOfSpryker\Client\ProductStorageExpander;

use FondOfSpryker\Client\ProductStorageExpander\Dependency\Client\ProductStorageExpanderToProductPageSearchExpanderClientInterface;
use Spryker\Client\Kernel\AbstractFactory;

class ProductStorageExpanderFactory extends AbstractFactory
{
    /**
     * @return ProductStorageExpanderToProductPageSearchExpanderClientInterface
     *
     * @throws
     */
    public function getProductPageSearchExpanderClient(): ProductStorageExpanderToProductPageSearchExpanderClientInterface
    {
        return $this->getProvidedDependency(ProductStorageExpanderDependecyProvider::CLIENT_PRODUCT_PAGE_SEARCH_EXPANDER);
    }
}
