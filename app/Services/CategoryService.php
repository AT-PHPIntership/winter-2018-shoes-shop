<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryService
{
    /**
    * Handle get categories list to data
    *
    * @return void
    */
    public function getList()
    {
        $categories = Category::where('delete_flag', 0)
                    ->paginate(config('paging.number_element_in_page'));
        return $categories;
    }
}
