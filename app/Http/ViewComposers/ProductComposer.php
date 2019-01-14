<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Services\ProductService;

class ProductComposer
{
    protected $products;

    /**
     * Contructor
     *
     * @param ProductService $products products
     *
     * @return void
     */
    public function __construct(ProductService $products)
    {
        $this->products = $products;
    }
    
    /**
     * Bind data to the view.
     *
     * @param View $view comment
     *
     * @return Illuminate\View\View
     */
    public function compose(View $view)
    {
        $view->with('products', $this->products->getAll(['id', 'name']));
    }
}
