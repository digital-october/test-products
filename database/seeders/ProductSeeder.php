<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Services\QuantityCalculator;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(QuantityCalculator $calculator)
    {
        $now = now();
        $data = $calculator->getLeftoverOfProductsByMovements()
            ->map(function ($product) use ($now) {
                $tmp['date'] = $product->date;
                $tmp['quantity'] = $product->quantity;
                $tmp['price'] = $product->price;
                $tmp['created_at'] = $now;
                $tmp['updated_at'] = $now;

                return $tmp;
            })
            ->toArray();

        Product::insert($data);
    }
}
