<?php

use App\Models\Role;

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
        return number_format($number).' đ';
    }
}
