<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Comment;
use Carbon\Carbon;

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

    /**
     * Get revenue this day, this week, this month, this year
     *
     * @return array
     */
    public function getRevenue()
    {
        $revenueThisDay = Order::where('status', 2)->where('shipped_at', Carbon::now()->format('Y-m-d'))->sum('price');
        $revenueThisWeek = Order::where('status', 2)->whereBetween('shipped_at', [Carbon::now()->startOfWeek()->format('Y-m-d'), Carbon::now()->endOfWeek()->format('Y-m-d')])->sum('price');
        $revenueThisMonth = Order::where('status', 2)->whereBetween('shipped_at', [Carbon::now()->startOfMonth()->format('Y-m-d'), Carbon::now()->endOfMonth()->format('Y-m-d')])->sum('price');
        $revenueThisYear = Order::where('status', 2)->whereBetween('shipped_at', [Carbon::now()->startOfYear()->format('Y-m-d'), Carbon::now()->endOfYear()->format('Y-m-d')])->sum('price');
        return [
            'revenueThisDay' => $revenueThisDay,
            'revenueThisWeek' => $revenueThisWeek,
            'revenueThisMonth' => $revenueThisMonth,
            'revenueThisYear' => $revenueThisYear,
        ];
    }
}
