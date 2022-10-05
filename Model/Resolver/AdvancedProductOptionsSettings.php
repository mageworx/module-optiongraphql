<?php
/**
 * Copyright © MageWorx. All rights reserved.
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace MageWorx\OptionGraphQl\Model\Resolver;

use MageWorx\OptionFeatures\Helper\Data as Helper;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlNoSuchEntityException;
use Magento\Framework\GraphQl\Query\Resolver\ContextInterface;
use Magento\Framework\GraphQl\Query\Resolver\Value;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\GraphQl\Query\ResolverInterface;

class AdvancedProductOptionsSettings implements ResolverInterface
{
    /**
     * @var Helper
     */
    protected $helper;

    /**
     * AdvancedProductOptionsSettings constructor.
     *
     * @param Helper $featuresHelper
     */
    public function __construct(
        Helper $helper
    ) {
        $this->helper = $helper;
    }

    /**
     * Fetches the data from persistence models and format it according to the GraphQL schema
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
        try {
            $data = [
                'is_swatch_title'                           => $this->helper->isShowSwatchTitle(),
                'is_show_swatch_price'                      => $this->helper->isShowSwatchPrice(),
                'is_qty_input_enabled'                      => $this->helper->isQtyInputEnabled(),
                'is_enabled_shareable_link'                 => $this->helper->isEnabledShareableLink(),
                'is_enabled_additional_product_price_field' => $this->helper->isEnabledAdditionalProductPriceField(),
                'tooltip_image_thumbnail_size'              => $this->helper->getTooltipImageThumbnailSize(),
                'additional_product_price_field_lable'      => $this->helper->getAdditionalProductPriceFieldLabel(),
                'additional_product_price_field_mode'       => $this->helper->getAdditionalProductPriceFieldMode(),
                'base_image_thumbnail_height'               => $this->helper->getBaseImageThumbnailHeight(),
                'base_image_thumbnail_width'                => $this->helper->getBaseImageThumbnailWidth(),
                'default_qty_label'                         => $this->helper->getDefaultQtyLabel(),
                'shareable_link_hint_text'                  => $this->helper->getShareableLinkHintText(),
                'shareable_link_success_text'               => $this->helper->getShareableLinkSuccessText(),
                'shareable_link_text'                       => $this->helper->getShareableLinkText(),
                'text_swatch_max_width'                     => $this->helper->getTextSwatchMaxWidth(),
                'swatch_width'                              => $this->helper->getSwatchWidth(),
                'swatch_height'                             => $this->helper->getSwatchHeight()
            ];

        } catch (NoSuchEntityException $e) {
            throw new GraphQlNoSuchEntityException(__($e->getMessage()), $e);
        }

        return $data;
    }
}