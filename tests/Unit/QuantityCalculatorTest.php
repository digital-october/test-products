<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Services\QuantityCalculator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;
use Tests\TestCase;

class QuantityCalculatorTest extends TestCase
{
    private QuantityCalculator $entityObject;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->entityObject = new QuantityCalculator();
    }

    /**
     * A basic test for calculation.
     *
     * @return void
     * @throws \Throwable
     */
    public function test_calculate()
    {
        $quantity = 5;
        $builder = $this->createMock(Builder::class);
        $productCollection = $this->createMock(Collection::class);
        $productModel = $this->createMock(Product::class);

        $productModel->expects(self::any())
            ->method('query')
            ->willReturn($builder);
        $builder->expects(self::any())
            ->method('where')
            ->willReturnSelf();
        $builder->expects(self::any())
            ->method('get')
            ->willReturn($productCollection);

        $sum = 10;
        $productCollection->expects(self::any())
            ->method('sum')
            ->willReturn($sum);

        $test = $this->entityObject->calculate($quantity);

        self::assertNotEmpty($test);
    }
}
