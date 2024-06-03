<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    public function testShow(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/users/' . $user->id);
        $response->assertStatus(Response::HTTP_OK);

        $response = $this->get('/users/' . 100009);
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }
}
