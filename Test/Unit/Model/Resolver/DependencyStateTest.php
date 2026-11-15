<?php
/**
 * Copyright © MageWorx. All rights reserved.
 * See LICENSE.txt for license details.
 */
declare(strict_types = 1);

namespace MageWorx\OptionGraphQl\Test\Unit\Model\Resolver;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Event\ManagerInterface;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\Serialize\Serializer\Json;
use MageWorx\OptionBase\Helper\Data as BaseHelper;
use MageWorx\OptionBase\Model\HiddenDependents as HiddenDependentsStorage;
use MageWorx\OptionGraphQl\Model\Resolver\DependencyState;
use PHPUnit\Framework\TestCase;

/**
 * @covers \MageWorx\OptionGraphQl\Model\Resolver\DependencyState
 */
class DependencyStateTest extends TestCase
{
    /** @var ManagerInterface|\PHPUnit\Framework\MockObject\MockObject */
    private $eventManager;

    /** @var DependencyState */
    private DependencyState $resolver;

    protected function setUp(): void
    {
        $productRepository = $this->createMock(ProductRepositoryInterface::class);
        $productRepository->method('get')->willReturn($this->createMock(ProductInterface::class));

        $storage = $this->createMock(HiddenDependentsStorage::class);
        $storage->method('getQuoteItemsHiddenDependents')->willReturn(null);

        $this->eventManager = $this->createMock(ManagerInterface::class);

        $this->resolver = new DependencyState(
            $this->createMock(BaseHelper::class),
            $productRepository,
            $storage,
            $this->eventManager,
            new Json()
        );
    }

    public function testOmittedSelectedValuesDispatchEmptyList(): void
    {
        self::assertSame([], $this->dispatchedSelectedValues(['productSku' => 'sku']));
    }

    public function testNullSelectedValuesDispatchEmptyList(): void
    {
        self::assertSame([], $this->dispatchedSelectedValues(['productSku' => 'sku', 'selectedValues' => null]));
    }

    public function testEmptyStringSelectedValuesDispatchEmptyList(): void
    {
        self::assertSame([], $this->dispatchedSelectedValues(['productSku' => 'sku', 'selectedValues' => '']));
    }

    public function testSelectedValuesAreSplitOnComma(): void
    {
        self::assertSame(
            ['2419', '2420'],
            $this->dispatchedSelectedValues(['productSku' => 'sku', 'selectedValues' => '2419,2420'])
        );
    }

    public function testEmptyEntriesAreDropped(): void
    {
        self::assertSame(
            ['2419', '2420'],
            $this->dispatchedSelectedValues(['productSku' => 'sku', 'selectedValues' => '2419,,2420,'])
        );
    }

    private function dispatchedSelectedValues(array $args): array
    {
        $dispatched = null;
        $this->eventManager->method('dispatch')->willReturnCallback(
            function (string $name, array $data) use (&$dispatched) {
                $dispatched = $data['selected_values'];
            }
        );

        $this->resolver->resolve(
            $this->createMock(Field::class),
            null,
            $this->createMock(ResolveInfo::class),
            null,
            $args
        );

        return $dispatched;
    }
}
