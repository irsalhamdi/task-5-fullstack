<?php

namespace Tests\Feature;

use App\Models\Category;
use Tests\TestCase;
use App\Models\User;

class CategoryTest extends TestCase
{
    public function test_lists_categories()
    { 
        $user = User::factory()->create();
        $token = $user->createToken($user->name)->accessToken;

        $this->withHeaders(['Authorization' => "Bearer $token"])
             ->get(route('categories'))
             ->assertStatus(200);
    }

    public function test_create_category()
    {
        $user = User::factory()->create();
        $token = $user->createToken($user->name)->accessToken;
        $data = [
            'name' => 'Sport',
            'user_id' => '1',
        ];

        $this->withHeaders(['Authorization' => "Bearer $token"])
             ->post(route('category.create'), $data)
             ->assertStatus(201)
             ->assertJson($data);
    }
    
    public function test_show_detail_category()
    {
        $user = User::factory()->create();
        $token = $user->createToken($user->name)->accessToken;
        $category = Category::where('id', 1)->first();

        $this->withHeaders(['Authorization' => "Bearer $token"])
             ->get(route('category.detail', $category->id))
             ->assertStatus(200);
    }

    public function test_update_category()
    {
        $user = User::factory()->create();
        $token = $user->createToken($user->name)->accessToken;
        $category = Category::where('id', 1)->first();

        $data = [
            'name' => 'Data Analyst',
            'user_id' => '1',
        ];

        $this->withHeaders(['Authorization' => "Bearer $token"])
             ->put(route('category.update', $category->id), $data)
             ->assertStatus(200);
    }

    public function test_delete_category()
    {
        $user = User::factory()->create();
        $token = $user->createToken($user->name)->accessToken;
        $category = Category::insertGetId([
            'name' => 'Data Analyst',
            'user_id' => '1',
        ]);

        $this->withHeaders(['Authorization' => "Bearer $token"])
             ->delete(route('category.delete', $category))
             ->assertStatus(204);
    }
}
