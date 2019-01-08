<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Services\CategoryService;

class CategoryComposer
{
    protected $categoryService;

    /**
     * Contructor
     *
     * @param CategoryService $categoryService categoryService
     *
     * @return void
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
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
        $view->with('categories', $this->categoryService->getAll(['id', 'name'], ['parent_id', '!=', null]));
    }
}
