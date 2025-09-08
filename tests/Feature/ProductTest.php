<?php

use App\Models\User;
use App\Models\Product;

test('unauthenticated user cannot access products page', function () {
    $response = $this->get('/products');
    $response->assertRedirect('/login');
});

test('authenticated user can list products', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    Product::create(['name' => 'Product 1', 'price' => 10.00]);
    Product::create(['name' => 'Product 2', 'price' => 20.00]);

    $response = $this->get('/products');
    $response->assertStatus(200);
    $response->assertSee('Product 1');
    $response->assertSee('Product 2');
});

test('authenticated user can store product', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->post('/products', [
        'name' => 'Test Product',
        'price' => 99.99,
    ]);

    $response->assertStatus(302);
    $this->assertDatabaseHas('products', [
        'name' => 'Test Product',
        'price' => 99.99,
    ]);
});

test('authenticated user can update product', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $product = Product::create([
        'name' => 'Old Name',
        'price' => 50.00,
    ]);

    $response = $this->patch("/products/{$product->id}", [
        'name' => 'Updated Name',
        'price' => 75.00,
    ]);

    $response->assertStatus(302);
    $this->assertDatabaseHas('products', [
        'id' => $product->id,
        'name' => 'Updated Name',
        'price' => 75.00,
    ]);
});

test('authenticated user can delete product', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $product = Product::create([
        'name' => 'Delete Me',
        'price' => 10.00,
    ]);

    $response = $this->delete("/products/{$product->id}");

    $response->assertStatus(302);
    $this->assertDatabaseMissing('products', [
        'id' => $product->id,
        'name' => 'Delete Me',
    ]);
});

test('authenticated user can view product create form', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->get('/products/create');
    $response->assertStatus(200);
        $response->assertSee('form');
});

test('authenticated user can view product update form', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $product = Product::create([
        'name' => 'Sample Product',
        'price' => 25.00,
    ]);

    $response = $this->get("/products/{$product->id}/edit");

    $response->assertStatus(200);
    $response->assertSee('Sample Product');
    $response->assertSee('value="25"', false);
    $response->assertSee('method="POST"', false);
    $response->assertSee('name="_method" value="PATCH"', false);
    $response->assertSee('type="submit"', false);
});


test('authenticated user can view product details', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $product = Product::create([
        'name' => 'Viewable Product',
        'price' => 42.00,
    ]);

    $response = $this->get("/products/{$product->id}");

    $response->assertStatus(200);
    $response->assertSee('Viewable Product');
    $response->assertSee('42.00');
});