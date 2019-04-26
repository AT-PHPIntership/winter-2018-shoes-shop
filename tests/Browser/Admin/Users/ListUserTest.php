<?php

namespace Tests\Browser\Admin\Users;

use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use \Tests\Browser\Admin\AdminTestCase;
use App\Models\User;
use \Tests\Browser\Pages\Admin\Users\ListUser;
use App\Models\Role;
use App\Models\Profile;

class ListUserTest extends AdminTestCase
{
    use DatabaseMigrations;

    const NUMBER_RECORD = 19;
    const ROW_LIMIT = 10;

    /**
    * Override function setUp() for make user login
    *
    * @return void
    */
    public function setUp() :void
    {
        parent::setUp();
        $users = factory(User::class, self::NUMBER_RECORD)->create([
            'role_id' => Role::ADMIN_ROLE,
        ]);
        foreach ($users as $user) {
            factory(Profile::class)->create([
                'user_id' => $user->id,
            ]);
        }
    }

    /**
     * A Dusk test show list user.
     *
     * @return void
     */
    public function testListUser()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                    ->visit(new ListUser);
        });
    }

     /**
     * A Dusk test show record with table has data.
     *
     * @return void
     */
    public function testShowRecord()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                    ->visit(new ListUser);
            $elements = $browser->elements('.table tbody tr');
            $this->assertCount(self::ROW_LIMIT, $elements - 1);
        });
    }

    /**
     * A Dusk test list user with paginattion
     *
     * @return void
     */
    public function testPagination()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                    ->visit(new ListUser);
            $number_page = count($browser->elements('.pagination li')) - 2;
            $this->assertEquals($number_page, ceil((self::NUMBER_RECORD) / (self::ROW_LIMIT)));
        });
    }
}
