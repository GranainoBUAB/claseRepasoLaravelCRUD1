<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    //R del CRUD
    public function test_CheckIfProductReceiveInJsonFile(){
        $products = Product::factory(2)->create();

        $response = $this->get(route('apiProduct'));

        $response->assertStatus(200)
            ->assertJsonCount(2);
    }

    //D del CRUD
    public function test_CheckIfCanDeleteProductsWithApi(){
        $products = Product::factory(2)->create();
        $response = $this->get(route('apiProduct'));
        $response->assertStatus(200)
            ->assertJsonCount(2);


        $response = $this->delete(route('apiDeleteProduct', 1));
        $this->assertDatabaseCount('products', 1);


        $response = $this->get(route('apiProduct'));
        $response->assertStatus(200)
            ->assertJsonCount(1);
    }

    //C del CRUD
    public function test_CheckIfCanCreateNewProductWithJsonFile(){

        $response = $this->post(route('apiCreateProduct'),[
            'name' => 'Cochecito Rojo',
            'price' => 36.95,
            'description' => 'este es un coche de plastico de color rojo para niños de mas de 7 años'
        ]);

        $response = $this->get(route('apiProduct'));
        $data1 = ['name' => "Cochecito Rojo"];
        $data2 = ['price' => 36.95];
        $data3 = ['description' => "este es un coche de plastico de color rojo para niños de mas de 7 años"];
        $response->assertStatus(200)
            ->assertJsonCount(1)
            ->assertJsonFragment($data1)
            ->assertJsonFragment($data2)
            ->assertJsonFragment($data3);

        $products = Product::factory(2)->create();

        $response = $this->post(route('apiCreateProduct'),[
            'name' => 'Cochecito verde',
            'price' => 45.35,
            'description' => 'igual que el coche rojo pero en verde'
        ]);

        $response = $this->get(route('apiProduct'));
        $data1 = ['name' => "Cochecito verde"];
        $data2 = ['price' => 45.35];
        $data3 = ['description' => "igual que el coche rojo pero en verde"];
        $response->assertStatus(200)
            ->assertJsonCount(4)
            ->assertJsonFragment($data1)
            ->assertJsonFragment($data2)
            ->assertJsonFragment($data3);
    }

    public function test_CheckIfCanUpdateOnePorductWithJsonFile(){
        $response = $this->post(route('apiCreateProduct'),[
            'name' => 'submarino amarillo',
            'price' => 22.45,
            'description' => 'patatas fritas con huevo'
        ]);

        $data = ['description' => "patatas fritas con huevo"];
        $response = $this->get(route('apiProduct'));
        $response->assertStatus(200)
        ->assertJsonCount(1)
        ->assertJsonFragment($data);

        $response = $this->put('/api/product/1', [
            'name' => 'submarino amarillo',
            'price' => 22.45,
            'description' => 'Vehiculo acuatico submergible amarillo'
        ]);

        $data = ['description' => "Vehiculo acuatico submergible amarillo"];
        $response = $this->get(route('apiProduct'));
        $response->assertStatus(200)
        ->assertJsonCount(1)
        ->assertJsonFragment($data);
    }
}

