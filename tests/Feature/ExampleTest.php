<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */

    use RefreshDatabase;
    
    public function test_authenticated_user_can_access_route(): void
    {
        $user =  \App\Models\User::factory()->create();

        $response = $this->actingAs($user)->get('/user');

        $response->assertStatus(200);

        $response->assertJson([
            'id' => $user->id,
            'email' => $user->email,
        ]);

        
    }
}


//worked how?
// $collection = (new MongoDB\Client)->test->users;

// $insertOneResult = $collection->insertOne([
//     'username' => 'admin',
//     'email' => 'admin@example.com',
//     'name' => 'Admin User',
// ]);

// printf("Inserted %d document(s)\n", $insertOneResult->getInsertedCount());

// var_dump($insertOneResult->getInsertedId());