<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Comment;

class StatisticalService
{
    /**
     * Get total order, product, user, comment
     *
     * @return array
     */
    public function getTotal()
    {
        $totalOrder = Order::all()->count();
        $totalProduct = Product::all()->count();
        $totalUser = User::all()->count();
        $totalComment = Comment::all()->count();
        return [
            'totalOrder' => $totalOrder,
            'totalProduct' => $totalProduct,
            'totalUser' => $totalUser,
            'totalComment' => $totalComment,
        ];

    }
}
