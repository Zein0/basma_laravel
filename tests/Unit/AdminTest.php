<?php

namespace Tests\Unit;

use App\Models\Admin;
use App\Models\User;
use Tests\TestCase;

class AdminTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
//    public function test_GetRegisteredUsers()
//    {
//        $admin=Admin::first();
//        User::factory()->count(10)->create();
//       $response= $this->actingAs($admin,'admin')->get('/api/admin/getRegistered');
//       $response->assertJsonFragment(['size'=>10]);
//
//    }
    public function test_Logout(){
        $admin=Admin::first();
        auth('admin')->login($admin);
        $response= $this->actingAs($admin,'admin')->get('/api/admin/logout');
        $response->assertJsonFragment(['message' => 'Successfully logged out']);
    }
}
