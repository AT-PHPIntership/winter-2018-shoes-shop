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

if (! function_exists('convertDTToDTL')) {
    /**
     * Function convertDTToDTL convert datetime to datetime-local
     *
     * @return string
     */
    function convertDTToDTL(string $dateTime)
    {
        return str_replace(' ', 'T', date("Y-m-d H:i", strtotime($dateTime)));
    }
}

if (! function_exists('convertDTLToDT')) {
    /**
     * Function convertDTLToDT convert datetime-local to datetime
     *
     * @return string
     */
    function convertDTLToDT(string $dateTimeLocal)
    {
        return date("Y-m-d H:i:s", strtotime($dateTimeLocal));
    }
}
