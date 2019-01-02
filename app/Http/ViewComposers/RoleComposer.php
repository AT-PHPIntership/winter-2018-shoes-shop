<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Services\RoleService;

class RoleComposer
{
    protected $roles;

    /**
     * Contructor
     *
     * @param RoleService $role comment
     */
    public function __construct(RoleService $roles)
    {
        $this->roles = $roles;
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
        $view->with('roles', $this->roles->getAll());
    }
}