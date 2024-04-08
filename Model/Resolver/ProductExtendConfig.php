<?php
/**
 * Copyright © MageWorx. All rights reserved.
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace MageWorx\OptionGraphQl\Model\Resolver;

use Magento\Store\Model\ScopeInterface;
use Magento\Catalog\Model\ProductRepository;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlNoSuchEntityException;
use Magento\Framework\GraphQl\Query\Resolver\ContextInterface;
use Magento\Framework\GraphQl\Query\Resolver\Value;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\Locale\Format;
use Magento\Framework\Pricing\PriceCurrencyInterface;
use Magento\Framework\Serialize\Serializer\Json as Serializer;
use MageWorx\OptionBase\Model\Product\Option\Attributes as OptionAttributes;
use MageWorx\OptionBase\Model\Product\Option\Value\Attributes as OptionValueAttributes;
use MageWorx\OptionBase\Helper\Data as BaseHelper;
use MageWorx\OptionBase\Helper\Price as BasePriceHelper;
use MageWorx\OptionBase\Model\Config\Base as BaseConfig;
use MageWorx\OptionBase\Block\Product\View\Options as ViewOptions;
use Magento\Framework\Registry;


class ProductExtendConfig implements ResolverInterface
{
    protected ViewOptions $viewOptions;
    protected Format $localeFormat;
    protected PriceCurrencyInterface $priceCurrency;
    protected OptionAttributes $optionAttributes;
    protected OptionValueAttributes $optionValueAttributes;
    protected BaseHelper $baseHelper;
    protected BasePriceHelper $basePriceHelper;
    protected BaseConfig $baseConfig;
    protected Serializer $serializer;
    protected ProductRepository $productRepository;
    protected Registry $registry;

    /**
     * ExtendConfig constructor.
     *
     * @param ViewOptions $viewOptions
     * @param Format $localeFormat
     * @param PriceCurrencyInterface $priceCurrency
     * @param OptionAttributes $optionAttributes
     * @param OptionValueAttributes $optionValueAttributes
     * @param BaseHelper $baseHelper
     * @param BasePriceHelper $basePriceHelper
     * @param BaseConfig $baseConfig
     * @param Serializer $serializer
     * @param ProductRepository $productRepository
     * @param Registry $registry
     */
    public function __construct(
        ViewOptions $viewOptions,
        Format $localeFormat,
        PriceCurrencyInterface $priceCurrency,
        OptionAttributes $optionAttributes,
        OptionValueAttributes $optionValueAttributes,
        BaseHelper $baseHelper,
        BasePriceHelper $basePriceHelper,
        BaseConfig $baseConfig,
        Serializer $serializer,
        ProductRepository $productRepository,
        Registry $registry
    ) {
        $this->viewOptions           = $viewOptions;
        $this->localeFormat          = $localeFormat;
        $this->priceCurrency         = $priceCurrency;
        $this->optionAttributes      = $optionAttributes;
        $this->optionValueAttributes = $optionValueAttributes;
        $this->baseHelper            = $baseHelper;
        $this->basePriceHelper       = $basePriceHelper;
        $this->baseConfig            = $baseConfig;
        $this->serializer            = $serializer;
        $this->productRepository     = $productRepository;
        $this->registry              = $registry;
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

            if (empty($this->registry->registry('current_product'))) {
                $this->registry->register('current_product', $product);
            }

            try {
                $store = $product->getStore();
                $currency = $store->getDefaultCurrency();
                $currencyCode = isset($currency) ? $currency->getCode() : null;
            } catch (\Exception $exception) {
                $currencyCode = null;
            }

            $regularPriceExclTax = $this->priceCurrency->convert(
                $this->baseConfig->getProductRegularPrice($product, false),
                ScopeInterface::SCOPE_STORE,
                $currencyCode
            );
            $regularPriceInclTax = $this->priceCurrency->convert(
                $this->baseConfig->getProductRegularPrice($product, true),
                ScopeInterface::SCOPE_STORE,
                $currencyCode
            );
            $finalPriceExclTax   = $this->priceCurrency->convert(
                $this->baseConfig->getProductFinalPrice($product, false, $qty),
                ScopeInterface::SCOPE_STORE,
                $currencyCode
            );
            $finalPriceInclTax   = $this->priceCurrency->convert(
                $this->baseConfig->getProductFinalPrice($product, true, $qty),
                ScopeInterface::SCOPE_STORE,
                $currencyCode
            );

            $data['option_json_config']             = $this->viewOptions->getJsonConfig();
            $data['product_json_config']            = $this->baseConfig->getProductJsonConfig($product, ScopeInterface::SCOPE_STORE, $currencyCode);
            $data['locale_price_format']            = $this->getLocalePriceFormat(ScopeInterface::SCOPE_STORE, $currencyCode);
            $data['product_final_price_incl_tax']   = $finalPriceInclTax;
            $data['product_final_price_excl_tax']   = $finalPriceExclTax;
            $data['product_regular_price_incl_tax'] = $regularPriceInclTax;
            $data['product_regular_price_excl_tax'] = $regularPriceExclTax;
            $data['price_display_mode']             = $this->baseConfig->getPriceDisplayMode();
            $data['catalog_price_contains_tax']     = $this->baseConfig->getCatalogPriceContainsTax();

        } catch (NoSuchEntityException $e) {
            throw new GraphQlNoSuchEntityException(__($e->getMessage()), $e);
        }

        return $data;
    }

    public function getLocalePriceFormat(?string $scope, ?string $currencyCode): string
    {
        $data                = $this->localeFormat->getPriceFormat(null, $currencyCode);
        $data['priceSymbol'] = $this->priceCurrency
            ->getCurrency($scope, $currencyCode)
            ->getCurrencySymbol();

        return $this->serializer->serialize($data);
    }
}
