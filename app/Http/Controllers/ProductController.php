<?php

namespace App\Http\Controllers;

use App\Services\QuantityCalculator;
use App\Http\Requests\CalculateQuantityRequest;
use Illuminate\Contracts\Support\Renderable;

class ProductController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        return view('main');
    }

    /**
     * Show result of calculation products quantity.
     *
     * @param CalculateQuantityRequest $request
     * @param QuantityCalculator $calculator
     * @return Renderable
     */
    public function calculateQuantity(
        CalculateQuantityRequest $request,
        QuantityCalculator $calculator,
    ): Renderable {
        try {
            $price = $calculator->calculate($request->quantity);
            return view('main', [
                'price' => $price,
            ]);
        } catch (\Throwable $exception) {
            return view('main', [
                'error' => $exception->getMessage(),
            ]);
        }
    }
}
