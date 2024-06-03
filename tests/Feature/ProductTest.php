<?php

declare(strict_types=1);

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic test example.
     */
    public function testStore(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $data = [
            'name'        => 'Example Product',
            'description' => 'Example description',
            'price'       => 100,
        ];

        $response = $this->post('/products/', $data);

        $response->assertStatus(Response::HTTP_CREATED);
    }

    public function testCreateProductForUnloggedInUser(): void
    {
        $response = $this->post('/products/');
        $response->assertStatus(Response::HTTP_FOUND);
    }

    public function testUpdate(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $product = Product::factory()->create();

        $data = [
            'name'        => 'New Name Product',
            'description' => 'Example description',
            'price'       => 100,
        ];

        $response = $this->put("/products/{$product->id}", $data);
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }


}
