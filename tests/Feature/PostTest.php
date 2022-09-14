<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Article;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    public function test_lists_posts()
    { 
        $user = User::factory()->create();
        $token = $user->createToken($user->name)->accessToken;

        $this->withHeaders(['Authorization' => "Bearer $token"])
             ->get(route('posts'))
             ->assertStatus(200);
    }

    public function test_create_posts()
    {
        $user = User::factory()->create();
        $token = $user->createToken($user->name)->accessToken;
        $data = [
            'title' => 'Quality Assurance',
            'content' => 'Quality Assurance adalah istilah yang digunakan baik di industri manufaktur dan jasa untuk menggambarkan upaya sistematis yang diambil untuk memastikan bahwa produk yang dikirimkan ke pelanggan memenuhi kontrak dan lainnya yang disepakati kinerja, desain, keandalan, dan harapan pemeliharaan pelanggan itu.',
            'image' => 'https://source.unsplash.com/random',
            'user_id' => '1',
            'category_id' => '1',
        ];

        $this->withHeaders(['Authorization' => "Bearer $token"])
             ->post(route('post.create'), $data)
             ->assertStatus(201)
             ->assertJson($data);
    }
    
    public function test_show_detail_posts()
    {
        $user = User::factory()->create();
        $token = $user->createToken($user->name)->accessToken;
        $post = Article::factory()->create();

        $this->withHeaders(['Authorization' => "Bearer $token"])
             ->get(route('post.detail', $post->id))
             ->assertStatus(200);
    }

    public function test_update_posts()
    {
        $user = User::factory()->create();
        $token = $user->createToken($user->name)->accessToken;
        $post = Article::factory()->create();

        $data = [
            'title' => 'Data Analyst',
            'content' => 'Data Analyst bertanggung jawab dalam menerjemahkan angka-angka menjadi laporan yang dapat dengan mudah dimengerti oleh manajemen. Setiap bisnis mengumpulkan data, baik data penjualan, riset pasar, logistik, atau biaya transportasi.',
            'user_id' => '1',
            'category_id' => '1',
        ];

        $this->withHeaders(['Authorization' => "Bearer $token"])
             ->put(route('post.detail', $post->id), $data)
             ->assertStatus(200);
    }

    public function test_delete_posts()
    {
        $user = User::factory()->create();
        $token = $user->createToken($user->name)->accessToken;
        $post = Article::factory()->create();

        $this->withHeaders(['Authorization' => "Bearer $token"])
             ->delete(route('post.delete', $post->id))
             ->assertStatus(204);
    }
}
