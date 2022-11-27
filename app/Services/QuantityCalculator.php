<?php

namespace App\Services;

use App\Models\{
    Product,
    Movement,
};
use Illuminate\Database\Eloquent\Collection;

class QuantityCalculator
{
    /**
     * Calculate the price of products in stock.
     *
     * @throws \Throwable
     */
    public function calculate(int $quantity): float
    {
        $products = Product::query()
            ->where('quantity', '!=', 0)
            ->orderBy('date')
            ->get();

        $total = $products->sum(function ($product) {
            return $product->quantity;
        });

        throw_if($quantity > $total, \Throwable::class);

        $price = 0;
        foreach ($products as $product) {
            $difference = $quantity - $product->quantity;
            if ($difference <= 0) {
                $price = ($product->price * $quantity) + $price;
                break;
            } else {
                $price = ($product->price * $product->quantity) + $price;
                $quantity = $difference;
            }
        }

        return $price;
    }

    /**
     * Calculate stock balances based on historical movements.
     *
     * @return Collection
     */
    public function getLeftoverOfProductsByMovements(): Collection
    {
        $movements = Movement::query()
            ->select([
                'date',
                'price',
                'quantity',
                'type',
            ])
            ->orderBy('date')
            ->get();
        $purchases = $movements->where('type', '=', Movement::PURCHASE_TYPE);
        $applications = $movements->where('type', '=', Movement::APP_TYPE);

        foreach ($applications as $application) {
            $quantity = $application->quantity;

            foreach ($purchases as &$purchase) {
                if ($purchase->quantity === 0) {
                    continue;
                }

                $quantity += $purchase->quantity;

                if ($quantity < 0) {
                    $purchase->quantity = 0;
                } else {
                    $purchase->quantity = $quantity;
                    break;
                }
            }
        }

        return $purchases->where('quantity', '!=', 0)->values();
    }
}
