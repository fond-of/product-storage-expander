<?php

namespace FondOfSpryker\Client\ProductStorageExpander\Plugin;

use FondOfSpryker\Shared\ProductStorageExpander\ProductStorageExpanderConstants;
use Generated\Shared\Transfer\ProductViewTransfer;
use Spryker\Client\Kernel\AbstractPlugin;
use Spryker\Client\ProductStorage\Dependency\Plugin\ProductViewExpanderPluginInterface;

/**
 * @method \FondOfSpryker\Client\ProductStorageExpander\ProductStorageExpanderFactory getFactory()
 */
class ProductViewProductsEqualModelKeyExpanderPlugin extends AbstractPlugin implements ProductViewExpanderPluginInterface
{
    /**
     * Specification:
     * - Expands and returns the provided ProductView transfer objects.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ProductViewTransfer $productViewTransfer
     * @param array $productData
     * @param string $localeName
     *
     * @return \Generated\Shared\Transfer\ProductViewTransfer
     */
    public function expandProductViewTransfer(
        ProductViewTransfer $productViewTransfer,
        array $productData,
        $localeName
    ): ProductViewTransfer {
        $productAttributes = $productViewTransfer->getAttributes();

        if (!isset($productAttributes[ProductStorageExpanderConstants::MODEL_KEY])) {
            return $productViewTransfer;
        }

        $productsWithEqualModelKey = $this
            ->getFactory()
            ->getProductPageSearchExpanderClient()
            ->getProductsWithSameModelKey($productAttributes[ProductStorageExpanderConstants::MODEL_KEY]);

        if (!isset($productsWithEqualModelKey['products'])) {
            return $productViewTransfer;
        }

        return $productViewTransfer->setProductsWithSameModelKey($productsWithEqualModelKey['products']);
    }
}
