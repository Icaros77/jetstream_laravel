<?php

namespace Tests\Feature;

use App\Models\ShoppingList;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Inertia\Testing\Assert;

class ShoppingListTest extends TestCase
{
    use RefreshDatabase;

    public function setup() :void {
        parent::setup();
        $seeder = new DatabaseSeeder;
        $seeder->run();
    }

    public function teardown() :void {
        parent::tearDown();
        $seeder = new DatabaseSeeder;
        $seeder->run();
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_obtain_shopping_list()
    {
        // $this->withoutExceptionHandling();
        $user = User::first();

        $shoppingList = ShoppingList::all();
        $this->actingAs($user);
        $this->assertAuthenticatedAs($user);
        $this->get(route("dashboard"))
            ->assertOk()
            ->assertInertia(function(Assert $page) use($shoppingList) {
                $page->component("Dashboard")
                ->hasAll([
                    "shoppingList" => $shoppingList->count(),
                ])
                ->whereAll([
                    "shoppingList" => $shoppingList,
                ]);
                
            } );
    }
}
