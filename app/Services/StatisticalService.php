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
        $revenueThisDay = Order::where('status', Order::ORDER_STATUS['DELIVERED'])->where('delivered_at', Carbon::now()->format('Y-m-d'))->sum('total_amount');
        $revenueThisWeek = Order::where('status', Order::ORDER_STATUS['DELIVERED'])->whereBetween('delivered_at', [Carbon::now()->startOfWeek()->format('Y-m-d'), Carbon::now()->endOfWeek()->format('Y-m-d')])->sum('total_amount');
        $revenueThisMonth = Order::where('status', Order::ORDER_STATUS['DELIVERED'])->whereBetween('delivered_at', [Carbon::now()->startOfMonth()->format('Y-m-d'), Carbon::now()->endOfMonth()->format('Y-m-d')])->sum('total_amount');
        $revenueThisYear = Order::where('status', Order::ORDER_STATUS['DELIVERED'])->whereBetween('delivered_at', [Carbon::now()->startOfYear()->format('Y-m-d'), Carbon::now()->endOfYear()->format('Y-m-d')])->sum('total_amount');
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

    /**
     * Get quantity order by status
     *
     * @return array
     */
    public function getQuantityOrderByStatus()
    {
        return [
            'confirmed' => Order::where('status', Order::ORDER_STATUS['CONFIRMED'])->count(),
            'processing' => Order::where('status', Order::ORDER_STATUS['PROCESSING'])->count(),
            'quality_check' => Order::where('status', Order::ORDER_STATUS['QUALITY_CHECK'])->count(),
            'dispatched_item' => Order::where('status', Order::ORDER_STATUS['DISPATCHED_ITEM'])->count(),
            'delivered' => Order::where('status', Order::ORDER_STATUS['DELIVERED'])->count(),
            'canceled' => Order::where('status', Order::ORDER_STATUS['CANCELED'])->count(),
            'pending' => Order::where('status', Order::ORDER_STATUS['PENDING'])->count(),
        ];
    }

    /**
     * Get list order from date to date
     *
     * @param string $fromDate fromDate
     * @param string $toDate   toDate
     *
     * @return Order
     */
    public function getOrdersBetweenTwoDate(string $fromDate, string $toDate)
    {
        $orders = Order::with(['user:id', 'user.profile:user_id,name', 'code:id,name'])->where('status', Order::ORDER_STATUS['DELIVERED'])->whereBetween('delivered_at', [$fromDate, $toDate])->get();
        $data = [];
        foreach ($orders as $key => $order) {
            $data[$key]['id'] = $key + 1;
            $data[$key]['order_id'] = $order['id'];
            $data[$key]['user_name'] = $order['user_id'] ? $order['user']['profile']['name'] : $order['customer_name'];
            $data[$key]['code_name'] = $order['code_id'] ? $order['code']['name'] : '';
            $data[$key]['order_created_at'] = date("Y-m-d", strtotime($order['created_at']));
            $data[$key]['order_delivered_at'] = $order['delivered_at'];
            $data[$key]['order_total_amount'] = $order['total_amount'];
        }
        return $data;
    }


    /**
     * Get list order from date to date
     *
     * @param string $field field
     * @param string $sort  sort
     *
     * @return Order
     */
    public function sortProduct(string $field, string $sort)
    {
        if ($field == 'inventory') {
            return Product::with(['category:id,name'])->select(['products.*', \DB::raw('`quantity` - `total_sold` as inventory')])->orderBy('inventory', $sort)->get();
        }
        return Product::with(['category:id,name'])->select(['products.*', \DB::raw('`quantity` - `total_sold` as inventory')])->orderBy($field, $sort)->get();
    }
}
