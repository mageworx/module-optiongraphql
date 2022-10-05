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
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\Pricing\PriceCurrencyInterface;
use Magento\Framework\Serialize\Serializer\Json as Serializer;
use MageWorx\OptionBase\Model\Product\Option\Attributes as OptionAttributes;
use MageWorx\OptionBase\Model\Product\Option\Value\Attributes as OptionValueAttributes;
use MageWorx\OptionBase\Helper\Data as BaseHelper;
use MageWorx\OptionBase\Helper\Price as BasePriceHelper;
use MageWorx\OptionBase\Model\Config\Base as BaseConfig;


class ProductExtendConfig implements ResolverInterface
{
    /**
     * @var \Magento\Framework\Locale\Format
     */
    protected $localeFormat;

    /**
     * @var PriceCurrencyInterface
     */
    protected $priceCurrency;

    /**
     * @var OptionAttributes
     */
    protected $optionAttributes;

    /**
     * @var OptionValueAttributes
     */
    protected $optionValueAttributes;

    /**
     * @var BaseHelper
     */
    protected $baseHelper;

    /**
     * @var BasePriceHelper
     */
    protected $basePriceHelper;

    /**
     * @var BaseConfig
     */
    protected $baseConfig;

    /**
     * @var Serializer
     */
    protected $serializer;

    /**
     * @var ProductRepository
     */
    protected $productRepository;

    /**
     * ExtendConfig constructor.
     *
     * @param \Magento\Framework\Locale\Format $localeFormat
     * @param PriceCurrencyInterface $priceCurrency
     * @param OptionAttributes $optionAttributes
     * @param OptionValueAttributes $optionValueAttributes
     * @param BaseHelper $baseHelper
     * @param BasePriceHelper $basePriceHelper
     * @param BaseConfig $baseConfig
     * @param Serializer $serializer
     * @param ProductRepository $productRepository
     */
    public function __construct(
        \Magento\Framework\Locale\Format $localeFormat,
        PriceCurrencyInterface $priceCurrency,
        OptionAttributes $optionAttributes,
        OptionValueAttributes $optionValueAttributes,
        BaseHelper $baseHelper,
        BasePriceHelper $basePriceHelper,
        BaseConfig $baseConfig,
        Serializer $serializer,
        ProductRepository $productRepository
    ) {
        $this->localeFormat          = $localeFormat;
        $this->priceCurrency         = $priceCurrency;
        $this->optionAttributes      = $optionAttributes;
        $this->optionValueAttributes = $optionValueAttributes;
        $this->baseHelper            = $baseHelper;
        $this->basePriceHelper       = $basePriceHelper;
        $this->baseConfig            = $baseConfig;
        $this->serializer            = $serializer;
        $this->productRepository     = $productRepository;
    }


    /**
     * Fetches the data from persistence models and format it according to the GraphQL schema.
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
            $productSku = $args['productSku'] ?? false;
            $qty        = $args['Qty'] ?? 1;

            $product = $this->productRepository->get($productSku);

            $data['product_json_config']            = $this->baseConfig->getProductJsonConfig($product);
            $data['locale_price_format']            = $this->getLocalePriceFormat();
            $data['product_final_price_incl_tax']   = $this->baseConfig->getProductFinalPrice($product, true, $qty);
            $data['product_final_price_excl_tax']   = $this->baseConfig->getProductFinalPrice($product, false, $qty);
            $data['product_regular_price_incl_tax'] = $this->baseConfig->getProductRegularPrice($product, true);
            $data['product_regular_price_excl_tax'] = $this->baseConfig->getProductRegularPrice($product, false);
            $data['price_display_mode']             = $this->baseConfig->getPriceDisplayMode();
            $data['catalog_price_contains_tax']     = $this->baseConfig->getCatalogPriceContainsTax();

        } catch (NoSuchEntityException $e) {
            throw new GraphQlNoSuchEntityException(__($e->getMessage()), $e);
        }

        return $data;
    }

    /**
     * @return string
     */
    public function getLocalePriceFormat(): string
    {
        $data                = $this->localeFormat->getPriceFormat();
        $data['priceSymbol'] = $this->priceCurrency->getCurrency()->getCurrencySymbol();

        return $this->serializer->serialize($data);
    }
}
