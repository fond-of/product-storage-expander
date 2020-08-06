<?php

namespace FondOfSpryker\Client\ProductStorageExpander\Plugin;

use FondOfSpryker\Shared\ProductPageSearchExpander\ProductPageSearchExpanderConstants;
use Generated\Shared\Transfer\ProductViewTransfer;
use Spryker\Client\Kernel\AbstractPlugin;
use Spryker\Client\ProductStorage\Dependency\Plugin\ProductViewExpanderPluginInterface;

/**
 * @method \FondOfSpryker\Client\ProductStorageExpander\ProductStorageExpanderFactory getFactory()
 */
class ProductViewProductsEqualModelKeyAndStyleKeyExpanderPlugin extends AbstractPlugin implements ProductViewExpanderPluginInterface
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

        if (!isset($productAttributes[ProductPageSearchExpanderConstants::MODEL_KEY])) {
            return $productViewTransfer;
        }

        if (!isset($productAttributes[ProductPageSearchExpanderConstants::STYLE_KEY])) {
            return $productViewTransfer;
        }

        $productsWithEqualModelKeyAndStyleKey = $this->getFactory()
            ->getProductPageSearchExpanderClient()
            ->getProductsWithSameModelKeyAndStyleKey(
                $productAttributes[ProductPageSearchExpanderConstants::MODEL_KEY],
                $productAttributes[ProductPageSearchExpanderConstants::STYLE_KEY]
            );

        if (!isset($productsWithEqualModelKeyAndStyleKey['products'])) {
            return $productViewTransfer;
        }

        return $productViewTransfer->setProductsWithSameModelKeyAndStyleKey($productsWithEqualModelKeyAndStyleKey['products']);
    }
}