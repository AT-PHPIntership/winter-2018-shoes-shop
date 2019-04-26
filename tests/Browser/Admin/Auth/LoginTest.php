<?php

namespace Tests\Browser\Admin\Auth;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use \Tests\Browser\Admin\AdminTestCase;

class LoginTest extends AdminTestCase
{
    use DatabaseMigrations;

    /**
    * Override function setUp() for make user login
    *
    * @return void
    */
    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Test admin login
     *
     * @return void
     */
    public function test_success_login_admin()
    {
        $this->browse(function ($browser) {
            $browser->visit('/admin/login')
                    ->type('email', $this->user->email)
                    ->type('password', 'secret')
                    ->press('ĐĂNG NHẬP')
                    ->assertPathIs('/admin/index');
        });
    }

    /**
     * Test admin logout
     *
     * @return void
     */
    public function test_logout_admin()
    {
        $this->browse(function ($browser) {
            $browser->loginAs($this->user)
                    ->visit('/admin/index')
                    ->click('.dropdown-toggle')
                    ->click('.user-footer .pull-right a')
                    ->assertPathIs('/admin/login');
        });
    }
}
