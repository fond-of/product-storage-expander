<?php

namespace FondOfSpryker\Client\ProductStorageExpander\Plugin;

use FondOfSpryker\Shared\ProductStorageExpander\ProductStorageExpanderConstants;
use Generated\Shared\Transfer\ProductViewTransfer;
use Spryker\Client\Kernel\AbstractPlugin;
use Spryker\Client\ProductStorageExtension\Dependency\Plugin\ProductViewExpanderPluginInterface;

/**
 * @method \FondOfSpryker\Client\ProductStorageExpander\ProductStorageExpanderFactory getFactory()
 */
class ProductViewSimilarProductsExpanderPlugin extends AbstractPlugin implements ProductViewExpanderPluginInterface
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

        if (!isset($productAttributes[ProductStorageExpanderConstants::STYLE_KEY])) {
            return $productViewTransfer;
        }

        $similiarProducts = $this->getFactory()
            ->getProductPageSearchExpanderClient()
            ->getSimilarProducts(
                $productAttributes[ProductStorageExpanderConstants::MODEL_KEY],
                $productAttributes[ProductStorageExpanderConstants::STYLE_KEY],
                ProductStorageExpanderConstants::OPTION_DONT_MERGE_SIZES
            );

        if (!isset($similiarProducts['products'])) {
            return $productViewTransfer;
        }

        return $productViewTransfer->setSimilarProducts($similiarProducts['products']);
    }
}
