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

if (! function_exists('convertToDateVN')) {
    /**
     * Function convertToDateVN convert date to date VN
     *
     * @param string $date date
     *
     * @return string
     */
    function convertToDateVN(string $date)
    {
        return date(config('define.date_vn'), strtotime($date));
    }
}
