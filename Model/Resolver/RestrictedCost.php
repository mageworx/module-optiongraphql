<?php
/**
 * Copyright © MageWorx. All rights reserved.
 * See LICENSE.txt for license details.
 */
declare(strict_types = 1);

namespace MageWorx\OptionGraphQl\Model\Resolver;

use Magento\Authorization\Model\UserContextInterface;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;

/**
 * Cost of goods is backend-only data: expose it to admin/integration tokens, never anonymously.
 */
class RestrictedCost implements ResolverInterface
{
    /**
     * @inheritdoc
     */
    public function resolve(
        Field       $field,
                    $context,
        ResolveInfo $info,
        ?array      $value = null,
        ?array      $args = null
    ) {
        if ($value === null || !$this->isPrivileged($context)) {
            return null;
        }

        $fieldName = $field->getName();

        return isset($value[$fieldName]) ? (string)$value[$fieldName] : null;
    }

    /**
     * Only admin and integration tokens may read cost data.
     *
     * @param mixed $context
     * @return bool
     */
    private function isPrivileged($context): bool
    {
        if (!$context || !method_exists($context, 'getUserType')) {
            return false;
        }

        return in_array(
            (int)$context->getUserType(),
            [UserContextInterface::USER_TYPE_ADMIN, UserContextInterface::USER_TYPE_INTEGRATION],
            true
        );
    }
}
