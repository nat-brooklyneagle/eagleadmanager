<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $user = User::factory()->create();

//        dump($user);
        $this->be($user);
//dump();
        $response = $this->get('/dashboard')
            ->assertInertia(fn (Assert $page) => $page
//                ->dd()
                ->component('Dashboard')
                ->dump('appName')
                ->where('appName', config('app.name'))
//                ->has('appName', fn(Assert $page) => $page->dump())

//                ->
//                ->component('ApplicationLogo')
//                ->has('applicationName')
//                ->has('applicationName', fn (Assert $page) => $page
//                ->)
//                ->where('id', $podcast->id)
            );
        ;

        $response->assertStatus(200);
    }
}
