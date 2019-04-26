<?php

namespace Tests\Browser\Pages\Admin\Users;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Page;

class ListUser extends Page
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/admin/users';
    }
    /**
     * Assert that the browser is on the page.
     *
     * @param Browser $browser browser
     *
     * @return void
     */
    public function assert(Browser $browser)
    {
        $browser->assertPathIs($this->url())
                ->assertSee('Danh sách người dùng')
                ->assertSee('Id')
                ->assertSee('Email')
                ->assertSee('Tên')
                ->assertSee('Chức vụ')
                ->assertSee('Hành động');
    }
    /**
     * Get the element shortcuts for the page.
     *
     * @return array
     */
    public function elements()
    {
        return [
            '@element' => '#selector',
        ];
    }
}
