<?php

namespace Tests\Browser\Admin;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\CreatesApplication;
use App\Models\Role;
use App\Models\Profile;

class AdminTestCase extends DuskTestCase
{
    use CreatesApplication;
    use DatabaseMigrations;

    protected $user;

    /**
     * Override function setUp() for make user login
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        
        \DB::table('m_roles')->insert([
            [
                'name' => 'admin',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'name' => 'customer',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
        ]);
        $this->user = factory('App\Models\User')->create([
            'role_id' => Role::ADMIN_ROLE,
        ]);
        Profile::create([
            'user_id' => $this->user->id,
            'name' => 'Thanh Bui V',
            'gender' => 1,
            'avatar' => '1551692122-demo_avatar.png',
            'address' => 'Da Nang',
        ]);
    }
}
