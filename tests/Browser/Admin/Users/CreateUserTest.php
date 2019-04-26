<?php
namespace Tests\Browser\Admin\Users;

use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Browser\Admin\AdminTestCase;
use Tests\Browser\Pages\Admin\Users\CreateUser;
use App\Models\Role;

class CreateUserTest extends AdminTestCase
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
     * A Dusk test create user.
     *
     * @return void
     */
    public function testCreateUser()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                    ->visit(new CreateUser);
        });
    }

    /**
     * List case for test validate for input
     *
     * @return array
     */
    public function listTestCaseValidate()
    {
        return [
            ['name', '', 'The name field is required.'],
            ['email', '', 'The email field is required.'],
            ['password', '', 'The password field is required.'],
            ['confirm_password', '', 'The confirm password field is required.'],
        ];
    }

    /**
     * Dusk test validate for input
     *
     * @param string $name name
     * @param string $content content
     * @param string $message message show when validate
     *
     * @dataProvider listTestCaseValidate
     *
     * @return void
     */
    public function testValidate($name, $content, $message)
    {
        $this->browse(function (Browser $browser) use ($name, $content, $message) {
            $browser->loginAs($this->user)
                    ->visit(new CreateUser)
                    ->type($name, $content)
                    ->select('role_id', '', 'The role id field is required.')
                    ->press(__('common.new'))
                    ->assertSee($message);
        });
    }

     /**
     * A Dusk test create product success.
     *
     * @return void
     */
    public function testCreateUserSuccess()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                    ->visit(new CreateUser)
                    ->type('email', 'thanhbui@gmail.com')
                    ->type('password', '123456')
                    ->type('confirm_password', '123456')
                    ->type('name', 'Thanh Bui V')
                    ->select('gender', 1)
                    ->type('phonenumber', '0121212121')
                    ->type('address', 'Da Nang')
                    ->attach('avatar', __DIR__.'/test/demo.jpg')
                    ->select('role_id', Role::find(1)->id)
                    ->press(__('common.new'))
                    ->assertSee(__('common.message.create_success'))
                    ->assertPathIs('/admin/users');
            $this->assertDatabaseHas(
                'users',
                [
                    'email' => 'thanhbui@gmail.com',
                    'role_id' => 1,
                ]
            );
            $this->assertDatabaseHas(
                'profiles',
                [
                    'name' => 'Thanh Bui V',
                    'gender' => 1,
                    'phonenumber' => '0121212121',
                    'address' => 'Da Nang',
                ]
            );
        });
    }
}
