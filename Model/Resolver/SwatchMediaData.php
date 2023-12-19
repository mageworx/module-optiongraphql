<?php
/**
 * Copyright © MageWorx. All rights reserved.
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace MageWorx\OptionGraphQl\Model\Resolver;

use Magento\Catalog\Model\ProductRepository;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlNoSuchEntityException;
use Magento\Framework\GraphQl\Query\Resolver\ContextInterface;
use Magento\Framework\GraphQl\Query\Resolver\Value;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\View\Result\PageFactory;
use MageWorx\OptionFeatures\Model\SwatchMediaData as SwatchData;

class SwatchMediaData implements ResolverInterface
{
    protected SwatchData $swatchData;
    protected ProductRepository $productRepository;
    protected PageFactory $pageFactory;

    /**
     * SwatchMediaData constructor.
     *
     * @param SwatchData $swatchData
     * @param ProductRepository $productRepository
     * @param PageFactory $pageFactory
     */
    public function __construct(
        SwatchData $swatchData,
        ProductRepository $productRepository,
        PageFactory $pageFactory
    ) {
        $this->swatchData        = $swatchData;
        $this->productRepository = $productRepository;
        $this->pageFactory       = $pageFactory;
    }

    /**
     * Fetches the data from persistence models and format it according to the GraphQL schema
     *
     * @param Field $field
     * @param ContextInterface $context
     * @param ResolveInfo $info
     * @param array|null $value
     * @param array|null $args
     * @return array|Value|mixed
     * @throws GraphQlNoSuchEntityException
     */
    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {
        try {
            $productSku = $args['productSku'] ?? false;
            $product    = $this->productRepository->get($productSku);
            $width      = $args['width'] ?? 0;
            $height     = $args['height'] ?? 0;

            $data = [
                'swatch_media_data' =>
                    $this->swatchData->getSwatchMediaData($product, $width, $height)

            ];
        } catch (NoSuchEntityException $e) {
            throw new GraphQlNoSuchEntityException(__($e->getMessage()), $e);
        }

        return $data;
    }
}
