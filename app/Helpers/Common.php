<?php

use App\Models\Role;
use App\Models\Review;

if (! function_exists('isAdminLogin')) {
    /**
     * Function isAdminLogin check user
     *
     * @return boolean
     */
    function isAdminLogin()
    {
        return Auth::user()->role->id === Role::ADMIN_ROLE;
    }
}

if (! function_exists('formatDateVN')) {
    /**
     * Function formatDateVN convert date to date VN
     *
     * @param string $date date
     *
     * @return string
     */
    function formatDateVN(string $date)
    {
        return date(config('define.format_date_vn'), strtotime($date));
    }
}

if (! function_exists('formatCurrencyVN')) {
    /**
     * Function formatCurrencyVN convert decimal to currency VN
     *
     * @param float $number number
     *
     * @return string
     */
    function formatCurrencyVN(float $number)
    {
        return number_format($number, 0, '', '.').' đ';
    }
}

if (! function_exists('isReview')) {
    /**
     * Function isReview check user review
     *
     * @param int $userId    userId
     * @param int $productId productId
     *
     * @return boolean
     */
    function isReview(int $userId, int $productId)
    {
        return Review::where('user_id', $userId)->where('product_id', $productId)->count() ? 1 : 0;
    }
}
