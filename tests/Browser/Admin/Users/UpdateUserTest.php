<?php

namespace Tests\Browser\Admin\Users;

use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Browser\Admin\AdminTestCase;
use Tests\Browser\Pages\Admin\Users\UpdateUser;

class UpdateUserTest extends AdminTestCase
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
     * Test update user
     *
     * @return void
     */
    public function testUpdateUser()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                    ->visit(new UpdateUser);
        });
    }
}
