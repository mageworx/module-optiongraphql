<?php
/**
 * Copyright © MageWorx. All rights reserved.
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace MageWorx\OptionGraphQl\Model\Resolver;

use Magento\Framework\Serialize\SerializerInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlNoSuchEntityException;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\GraphQl\Query\ResolverInterface;

class AdvancedProductOptionsSettings implements ResolverInterface
{
    protected SerializerInterface $serializer;
    protected array $data;

    /**
     * AdvancedProductOptionsSettings constructor.
     *
     * @param SerializerInterface $serializer
     * @param $data
     */
    public function __construct(
        SerializerInterface $serializer,
        $data = [],
    ) {
        $this->serializer = $serializer;
        $this->data       = $data;
    }

    /**
     * Fetches the data from persistence models and format it according to the GraphQL schema
     *
     * @param Field $field
     * @param $context
     * @param ResolveInfo $info
     * @param array|null $value
     * @param array|null $args
     * @return array
     * @throws GraphQlNoSuchEntityException
     * @throws \Exception
     */
    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ): array {
        return $this->resolveData();
    }

    public function resolveData(): array
    {
        $resultData = [];
        foreach ($this->data as $key => $helper) {
            switch ($key) {
                case 'features_helper':
                    $selectionLimitTemplateData = $this->serializer->serialize(
                        $helper->getSelectionLimitTemplateData()
                    );

                    //OptionFeatures section
                    $featuresData = [
                        'product_price_display_mode'                  => $helper->getProductPriceDisplayMode(),
                        'is_enabled_additional_product_price_field'   =>
                            $helper->isEnabledAdditionalProductPriceField(),
                        'additional_product_price_field_label'        =>
                            $helper->getAdditionalProductPriceFieldLabel(),
                        'additional_product_price_field_mode'         =>
                            $helper->getAdditionalProductPriceFieldMode(),
                        'is_qty_input_enabled'                        => $helper->isQtyInputEnabled(),
                        'default_qty_label'                           => $helper->getDefaultQtyLabel(),
                        'is_option_value_description_enabled'         => $helper->isOptionValueDescriptionEnabled(),
                        'is_option_description_enabled'               => $helper->isOptionDescriptionEnabled(),
                        'get_option_description_mode'                 => $helper->getOptionDescriptionMode(),
                        'selection_limit_template_data'               => $selectionLimitTemplateData,
                        'base_image_thumbnail_height'                 => $helper->getBaseImageThumbnailHeight(),
                        'base_image_thumbnail_width'                  => $helper->getBaseImageThumbnailWidth(),
                        'tooltip_image_thumbnail_size'                => $helper->getTooltipImageThumbnailSize(),
                        'is_enabled_shareable_link'                   => $helper->isEnabledShareableLink(),
                        'shareable_link_text'                         => $helper->getShareableLinkText(),
                        'shareable_link_hint_text'                    => $helper->getShareableLinkHintText(),
                        'shareable_link_success_text'                 => $helper->getShareableLinkSuccessText(),
                        'is_load_linked_product_enabled'              => $helper->isLoadLinkedProductEnabled(),
                        'is_enabled_fide_value_price'                 => $helper->isEnabledHideValuePrice(),
                        'is_enabled_hide_product_page_value_price'    =>
                            $helper->isEnabledHideProductPageValuePrice(),
                        'is_enabled_customize_and_add_to_cart_button' => $helper->isEnabledCustAndAddToCartButton()

                    ];

                    //OptionSwatches section
                    $swatchesData = [
                        'is_show_swatch_title'  => $helper->isShowSwatchTitle(),
                        'is_show_swatch_price'  => $helper->isShowSwatchPrice(),
                        'swatch_width'          => $helper->getSwatchWidth(),
                        'swatch_height'         => $helper->getSwatchHeight(),
                        'text_swatch_max_width' => $helper->getTextSwatchMaxWidth()
                    ];

                    $data = array_merge($featuresData, $swatchesData);
                    break;
                case 'inventory_helper':
                    //OptionInventory Section
                    $data = [
                        'is_enabled_option_inventory'                      =>
                            $helper->isEnabledOptionInventory(),
                        'is_display_option_inventory_on_frontend'          =>
                            $helper->isDisplayOptionInventoryOnFrontend(),
                        'is_display_out_of_stock_message'                  =>
                            $helper->isDisplayOutOfStockMessage(),
                        'is_display_out_of_stock_message_on_options_level' =>
                            $helper->isDisplayOutOfStockMessageOnOptionsLevel(),
                        'is_display_out_of_stock_options'                  =>
                            $helper->isDisplayOutOfStockOptions(),
                        'is_require_hidden_out_of_stock_options'           =>
                            $helper->isRequireHiddenOutOfStockOptions()
                    ];
                    break;
                case 'advanced_pricing_helper':
                    //OptionAdvancedPricing Section
                    $data = [
                        'is_special_price_enabled'           => $helper->isSpecialPriceEnabled(),
                        'is_tier_price_enabled'              => $helper->isTierPriceEnabled(),
                        'is_display_tier_price_table_needed' => $helper->isDisplayTierPriceTableNeeded()
                    ];
                    break;
                default:
                    throw new \Exception('Unexpected object key');
            }

            $resultData = array_merge($resultData, $data);
        }

        return $resultData;
    }
}
