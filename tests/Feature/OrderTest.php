<?php

declare(strict_types=1);

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use DatabaseTransactions;

    public function testStore(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $products                 = Product::factory()->count(5)->create();
        $productsData['products'] = $products->map(function ($product) {
            return ['product_id' => $product->id, 'price' => $product->price, 'quantity' => rand(1, 5)];
        })->toArray();

        $response = $this->post('/orders/', $productsData);
        $response->assertStatus(Response::HTTP_OK);

        $this->artisan('queue:work --once --queue=' . config('queue.orders'))->assertExitCode(0);
        $this->artisan('queue:work --once --queue=' . config('queue.emails'))->assertExitCode(0);
    }


    public function testShow(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $order = Order::factory()->create();

        $response = $this->get('/orders/' . $order->id);
        $response->assertStatus(Response::HTTP_OK);

        $response = $this->get('/orders/' . 1000090);
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }


}
