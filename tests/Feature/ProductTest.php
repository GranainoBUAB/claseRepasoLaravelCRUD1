<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    use RefreshDatabase;

    public function test_list_product_in_blade(){

        $this->withoutExceptionHandling();

        $products = Product::factory(5)->create();

        Product::all();

        $response = $this->get('/');

        $response->assertStatus(200)
            ->assertViewIs('home');
    }
}
