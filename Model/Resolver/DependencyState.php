<?php
/**
 * Copyright © MageWorx. All rights reserved.
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace MageWorx\OptionGraphQl\Model\Resolver;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Exception\GraphQlNoSuchEntityException;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\Event\ManagerInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Serialize\SerializerInterface;
use MageWorx\OptionBase\Model\HiddenDependents as HiddenDependentsStorage;
use MageWorx\OptionBase\Helper\Data as BaseHelper;

/**
 * DependencyState page field resolver for GraphQL request processing
 */
class DependencyState implements ResolverInterface
{
    protected BaseHelper $baseHelper;
    protected ProductRepositoryInterface $productRepository;
    protected HiddenDependentsStorage $hiddenDependentsStorage;
    protected ManagerInterface $eventManager;
    protected SerializerInterface $serializer;

    /**
     * @param BaseHelper $baseHelper
     * @param ProductRepositoryInterface $productRepository
     * @param HiddenDependentsStorage $hiddenDependentsStorage
     * @param ManagerInterface $eventManager
     */
    public function __construct(
        BaseHelper $baseHelper,
        ProductRepositoryInterface $productRepository,
        HiddenDependentsStorage $hiddenDependentsStorage,
        ManagerInterface $eventManager,
        SerializerInterface $serializer
    ) {
        $this->baseHelper              = $baseHelper;
        $this->productRepository       = $productRepository;
        $this->hiddenDependentsStorage = $hiddenDependentsStorage;
        $this->eventManager            = $eventManager;
        $this->serializer              = $serializer;
    }

    /**
     * @inheritdoc
     */
    public function resolve(
        Field       $field,
                    $context,
        ResolveInfo $info,
        ?array      $value = null,
        ?array      $args = null
    ): array {
        try {
            $productSku           = $args['productSku'] ?? false;
            $selectedValuesString = $args['selectedValues'] ?? [];
            $selectedValues       = explode(',', $selectedValuesString);

            $product = $this->productRepository->get($productSku);
            if (!$product) {
                throw new GraphQlNoSuchEntityException(__('Wrong product SKU'));
            }

            $this->eventManager->dispatch(
                'mageworx_calculate_dependency_state',
                ['product' => $product, 'selected_values' => $selectedValues]
            );

            $data = $this->hiddenDependentsStorage->getQuoteItemsHiddenDependents();
            if (!$data) {
                $data = [
                    'hidden_options'     => [],
                    'hidden_values'      => [],
                    'preselected_values' => []
                ];
            }

            $data['preselected_values'] = $this->serializer->serialize($data['preselected_values']);
        } catch (NoSuchEntityException $e) {
            throw new GraphQlNoSuchEntityException(__($e->getMessage()), $e);
        }

        return $data;
    }
}
