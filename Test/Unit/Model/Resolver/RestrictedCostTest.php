<?php
/**
 * Copyright © MageWorx. All rights reserved.
 * See LICENSE.txt for license details.
 */
declare(strict_types = 1);

namespace MageWorx\OptionGraphQl\Test\Unit\Model\Resolver;

use Magento\Authorization\Model\UserContextInterface;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\GraphQl\Model\Query\ContextInterface;
use MageWorx\OptionGraphQl\Model\Resolver\RestrictedCost;
use PHPUnit\Framework\TestCase;

/**
 * Security regression: cost / absolute_cost used to be readable by any anonymous
 * GraphQL visitor (finding A5).
 *
 * @covers \MageWorx\OptionGraphQl\Model\Resolver\RestrictedCost
 */
class RestrictedCostTest extends TestCase
{
    /** @var RestrictedCost */
    private RestrictedCost $resolver;

    protected function setUp(): void
    {
        $this->resolver = new RestrictedCost();
    }

    public function testAnonymousVisitorGetsNull(): void
    {
        self::assertNull($this->resolve(UserContextInterface::USER_TYPE_GUEST));
    }

    public function testLoggedInCustomerGetsNull(): void
    {
        self::assertNull($this->resolve(UserContextInterface::USER_TYPE_CUSTOMER));
    }

    public function testAdminTokenGetsTheValue(): void
    {
        self::assertSame('12.5', $this->resolve(UserContextInterface::USER_TYPE_ADMIN));
    }

    public function testIntegrationTokenGetsTheValue(): void
    {
        self::assertSame('12.5', $this->resolve(UserContextInterface::USER_TYPE_INTEGRATION));
    }

    public function testMissingValueArrayIsNull(): void
    {
        self::assertNull($this->resolve(UserContextInterface::USER_TYPE_ADMIN, null));
    }

    private function resolve(int $userType, ?array $value = ['cost' => '12.5'])
    {
        $field = $this->createMock(Field::class);
        $field->method('getName')->willReturn('cost');

        $context = $this->createMock(ContextInterface::class);
        $context->method('getUserType')->willReturn($userType);

        $info = $this->createMock(ResolveInfo::class);

        return $this->resolver->resolve($field, $context, $info, $value);
    }
}
