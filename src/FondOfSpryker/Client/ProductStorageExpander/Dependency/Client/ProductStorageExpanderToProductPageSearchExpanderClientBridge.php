<?php

namespace FondOfSpryker\Client\ProductStorageExpander\Dependency\Client;

use FondOfSpryker\Client\ProductPageSearchExpander\ProductPageSearchExpanderClientInterface;

class ProductStorageExpanderToProductPageSearchExpanderClientBridge implements ProductStorageExpanderToProductPageSearchExpanderClientInterface
{
    /**
     * @var \FondOfSpryker\Client\ProductPageSearchExpander\ProductPageSearchExpanderClientInterface
     */
    protected $productPageSearchExpanderClient;

    /**
     * @param ProductPageSearchExpanderClientInterface $productPageSearchExpanderClient
     */
    public function __construct(ProductPageSearchExpanderClientInterface $productPageSearchExpanderClient)
    {
        $this->productPageSearchExpanderClient = $productPageSearchExpanderClient;
    }

    /**
     * @param string $modelKey
     * @param string $size
     *
     * @return array|null
     */
    public function getProductsWithSameModelKeyAndSize(string $modelKey, string $size): ?array
    {
        return $this->productPageSearchExpanderClient->getProductsWithSameModelKeyAndSize($modelKey, $size);
    }

    /**
     * @param string $modelKey
     * @param string $styleKey
     *
     * @return array|null
     */
    public function getProductsWithSameModelKeyAndStyleKey(string $modelKey, string $styleKey): ?array
    {
        return $this->productPageSearchExpanderClient->getProductsWithSameModelKeyAndStyleKey($modelKey, $styleKey);
    }

    /**
     * @param string $modelKey
     *
     * @return array|null
     */
    public function getProductsWithSameModelKey(string $modelKey): ?array
    {
        return $this->productPageSearchExpanderClient->getProductsWithSameModelKey($modelKey);
    }

    /**
     * @param string $styleKey
     *
     * @return array|null
     */
    public function getProductsWithSameStyleKey(string $styleKey): ?array
    {
        return $this->productPageSearchExpanderClient->getProductsWithSameStyleKey($styleKey);
    }

    /**
     * @param string $modelKey
     * @param string $styleKey
     * @param string|null $optionDontMergeSizes
     *
     * @return array|null
     * @deprecated
     */
    public function getSimilarProducts(string $modelKey, string $styleKey, ?string $optionDontMergeSizes): ?array
    {
        return $this->productPageSearchExpanderClient->getSimilarProducts($modelKey, $styleKey, $optionDontMergeSizes);
    }

    /**
     * @param string $modelShort
     * @param string $styleKey
     * @param string|null $optionSizeSwitcher
     *
     * @return array|null
     * @deprecated use getProductsWithSameModelKeyAndStyleKey() instead
     */
    public function getProductsSizeSwitcher(string $modelShort, string $styleKey, ?string $optionSizeSwitcher): ?array
    {
        return $this->productPageSearchExpanderClient->getProductsSizeSwitcher($modelShort, $styleKey, $optionSizeSwitcher);
    }
}
