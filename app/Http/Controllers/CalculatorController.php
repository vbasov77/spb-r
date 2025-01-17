<?php

namespace App\Http\Controllers;


use Illuminate\View\View;

class CalculatorController extends Controller
{

    /**
     * @return View
     */
    public function omega3Calculator()
    {
        return view('calculators.omega3');
    }

    /**
     * @return View
     */
    public function productsCalculator()
    {
        return view('calculators.products');
    }

    /**
     * @return View
     */
    public function productSumPacCalculator()
    {
        return view('calculators.product_sum_pack');
    }

}
