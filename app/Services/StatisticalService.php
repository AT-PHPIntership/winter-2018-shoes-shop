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
        $totalOrder = Order::count();
        $totalProduct = Product::count();
        $totalUser = User::count();
        $totalComment = Comment::count();
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
        $revenueThisDay = Order::where('status', 6)->where('delivered_at', Carbon::now()->format('Y-m-d'))->sum('total_amount');
        $revenueThisWeek = Order::where('status', 6)->whereBetween('delivered_at', [Carbon::now()->startOfWeek()->format('Y-m-d'), Carbon::now()->endOfWeek()->format('Y-m-d')])->sum('total_amount');
        $revenueThisMonth = Order::where('status', 6)->whereBetween('delivered_at', [Carbon::now()->startOfMonth()->format('Y-m-d'), Carbon::now()->endOfMonth()->format('Y-m-d')])->sum('total_amount');
        $revenueThisYear = Order::where('status', 6)->whereBetween('delivered_at', [Carbon::now()->startOfYear()->format('Y-m-d'), Carbon::now()->endOfYear()->format('Y-m-d')])->sum('total_amount');
        return [
            'revenueThisDay' => $revenueThisDay,
            'revenueThisWeek' => $revenueThisWeek,
            'revenueThisMonth' => $revenueThisMonth,
            'revenueThisYear' => $revenueThisYear,
        ];
    }

    /**
     * Get revenue this day, this week, this month, this year
     *
     * @return array
     */
    public function getTopSell()
    {
        $topSellThisDay = $this->getTopSellBetweenDate(Carbon::now()->format('Y-m-d'), Carbon::now()->format('Y-m-d'));
        $topSellThisWeek = $this->getTopSellBetweenDate(Carbon::now()->startOfWeek()->format('Y-m-d'), Carbon::now()->endOfWeek()->format('Y-m-d'));
        $topSellThisMonth = $this->getTopSellBetweenDate(Carbon::now()->startOfMonth()->format('Y-m-d'), Carbon::now()->endOfMonth()->format('Y-m-d'));
        $topSellThisYear = $this->getTopSellBetweenDate(Carbon::now()->startOfYear()->format('Y-m-d'), Carbon::now()->endOfYear()->format('Y-m-d'));
        return [
            'topSellThisDay' => $topSellThisDay,
            'topSellThisWeek' => $topSellThisWeek,
            'topSellThisMonth' => $topSellThisMonth,
            'topSellThisYear' => $topSellThisYear,
        ];
    }

    /**
     * Get top sell
     *
     * @param string $fromDate fromDate
     * @param string $toDate   toDate
     *
     * @return object
     */
    public function getTopSellBetweenDate(string $fromDate, string $toDate)
    {
        return \DB::table('orders as o')
        ->join('order_details as od', 'o.id', '=', 'od.order_id')
        ->join('products as p', 'od.product_id', '=', 'p.id')
        ->select(\DB::raw('count(product_id) as total, name, p.quantity as product_quantity, total_sold, p.id as product_id'))
        ->where('o.status', '=', 6)
        ->whereBetween('delivered_at', [$fromDate, $toDate])
        ->orderByRaw('total DESC')
        ->groupBy('product_id')
        ->limit(config('define.statistical.limit_top_sell'))
        ->get();
    }
}
