<?php
/**
 * Copyright © MageWorx. All rights reserved.
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace MageWorx\OptionGraphQl\Model\Resolver;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlNoSuchEntityException;
use Magento\Framework\GraphQl\Query\Resolver\ContextInterface;
use Magento\Framework\GraphQl\Query\Resolver\Value;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Catalog\Model\ProductRepository;
use Magento\Catalog\Model\Product\Type\Price;
use Magento\Framework\Serialize\Serializer\Json as Serializer;
use MageWorx\OptionBase\Helper\Price as BasePriceHelper;

class ProductFinalPrice implements ResolverInterface
{
    /**
     * @var ProductRepository
     */
    protected $productRepository;

    /**
     * @var Price
     */
    protected $priceModel;

    /**
     * @var Serializer
     */
    protected $serializer;

    /**
     * Item options prefix
     */
    const OPTION_PREFIX = \Magento\Catalog\Model\Product\Type\AbstractType::OPTION_PREFIX;

    /**
     * @var BasePriceHelper
     */
    protected $basePriceHelper;

    /**
     * ProductFinalPrice constructor.
     *
     * @param ProductRepository $productRepository
     * @param Price $priceModel
     * @param Serializer $serializer
     * @param BasePriceHelper $basePriceHelper
     */
    public function __construct(
        ProductRepository $productRepository,
        Price $priceModel,
        Serializer $serializer,
        BasePriceHelper $basePriceHelper
    ) {
        $this->productRepository = $productRepository;
        $this->priceModel        = $priceModel;
        $this->serializer        = $serializer;
        $this->basePriceHelper   = $basePriceHelper;
    }


    /**
     * Fetches the data from persistence models and format it according to the GraphQL schema.
     * Example $args['currentOptions'] = '{"1120":"8076","1121":"","1122":""}'
     *
     * @param \Magento\Framework\GraphQl\Config\Element\Field $field
     * @param ContextInterface $context
     * @param ResolveInfo $info
     * @param array|null $value
     * @param array|null $args
     * @return mixed|Value
     * @throws \Exception
     */
    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {
        $data = [];

        try {
            $productSku           = $args['productSku'] ?? false;
            $selectedValuesString = $args['currentOptions'] ?? false;
            $qty                  = $args['currentQty'] ?? 1;

            if ($selectedValuesString && $productSku) {
                $product             = $this->productRepository->get($productSku);
                $unserializedOptions = $this->serializer->unserialize($selectedValuesString);
                if ($unserializedOptions) {
                    $optionIds = array_keys($unserializedOptions);
                    $product->addCustomOption('option_ids', implode(',', $optionIds));
                    foreach ($unserializedOptions as $optionId => $optionValue) {
                        $product->addCustomOption(self::OPTION_PREFIX . $optionId, $optionValue);
                    }

                    $product->setHasCustomOptions(true);
                    $basePrice          = (float)$this->priceModel->getFinalPrice($qty, $product);
                    $data['base_price'] = $basePrice;

                    $isCatalogPriceContainsTax = $this->basePriceHelper->getCatalogPriceContainsTax(
                        $product->getStoreId()
                    );
                    $needTax                   = !$isCatalogPriceContainsTax ?? true;

                    $data['final_price'] = (float)$this->basePriceHelper->getTaxPrice(
                        $product,
                        $basePrice,
                        $needTax
                    );
                }
            }
        } catch (NoSuchEntityException $e) {
            throw new GraphQlNoSuchEntityException(__($e->getMessage()), $e);
        }

        return $data;
    }
}
