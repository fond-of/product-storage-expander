<?php

namespace FondOfSpryker\Client\ProductStorageExpander\Plugin;

use FondOfSpryker\Shared\ProductStorageExpander\ProductStorageExpanderConstants;
use Generated\Shared\Transfer\ProductViewTransfer;
use Spryker\Client\Kernel\AbstractPlugin;
use Spryker\Client\ProductStorage\Dependency\Plugin\ProductViewExpanderPluginInterface;

/**
 * @method \FondOfSpryker\Client\ProductStorageExpander\ProductStorageExpanderFactory getFactory()
 */
class ProductViewProductsEqualStyleKeyExpanderPlugin extends AbstractPlugin implements ProductViewExpanderPluginInterface
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

        if (!isset($productAttributes[ProductStorageExpanderConstants::STYLE_KEY])) {
            return $productViewTransfer;
        }

        $productsWithEqualStyleKey = $this
            ->getFactory()
            ->getProductPageSearchExpanderClient()
            ->getProductsWithSameStyleKey($productAttributes[ProductStorageExpanderConstants::STYLE_KEY]);

        if (!isset($productsWithEqualStyleKey['products'])) {
            return $productViewTransfer;
        }

        return $productViewTransfer->setProductsWithSameStyleKey($productsWithEqualStyleKey['products']);
    }
}
