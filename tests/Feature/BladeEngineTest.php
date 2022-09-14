<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\UploadedFile;
use App\Providers\RouteServiceProvider;

class BladeEngineTest extends TestCase
{
    public function test_login_page()
    {
        $this->withoutExceptionHandling();
        $this->get('login')->assertStatus(200);
    }

    public function test_login_authenticated()
    {
        $user = User::factory()->create();
        $response = $this->post('/login', ['email' => $user->email, 'password' => 'password']);
        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    public function test_posts_page()
    {
        $this->get('/')->assertStatus(200);
    }

    public function test_category_page()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $response = $this->post('/login', ['email' => $user->email, 'password' => 'password']);
        $this->assertAuthenticated();
        $this->get('/user/categories')->assertStatus(200);
    }

    public function test_new_category_page()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $response = $this->post('/login', ['email' => $user->email, 'password' => 'password']);
        $this->assertAuthenticated();
        $this->get('/user/category/create')->assertStatus(200);
    }

    public function test_user_create_category()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $response = $this->post('/login', ['email' => $user->email, 'password' => 'password']);
        $this->assertAuthenticated();
        $category = ['name' => 'Sport', 'user_id' => 2];
        $this->post(route('create.category',$category))->assertRedirect('/user/categories');
    }

    public function test_edit_category_page()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $response = $this->post('/login', ['email' => $user->email, 'password' => 'password']);
        $this->assertAuthenticated();
        $category = Category::where('id', 1)->first();
        $this->get(route('edit.category',$category->id))->assertStatus(200);
    }   
    
    public function test_user_update_category()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $response = $this->post('/login', ['email' => $user->email, 'password' => 'password']);
        $this->assertAuthenticated();
        $category = Category::where('id', 1)->first();
        $data = ['name' => 'Travelling', 'user_id' => 2];
        $this->post(route('update.category',$category->id), $data)->assertRedirect('/user/categories');
    }

    public function test_user_delete_category()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $response = $this->post('/login', ['email' => $user->email, 'password' => 'password']);
        $this->assertAuthenticated();

        $category = Category::insertGetId([
            'name' => 'Data Analyst',
            'user_id' => 1,
        ]);

        $this->get(route('delete.category',$category))->assertRedirect('/user/categories');
    }

    public function test_article_page()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $response = $this->post('/login', ['email' => $user->email, 'password' => 'password']);
        $this->assertAuthenticated();
        $this->get('/user/articles')->assertStatus(200);
    }

    public function test_new_article_page()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $response = $this->post('/login', ['email' => $user->email, 'password' => 'password']);
        $this->assertAuthenticated();
        $this->get('/user/article/create')->assertStatus(200);
    }

    public function test_edit_article_page()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $response = $this->post('/login', ['email' => $user->email, 'password' => 'password']);
        $this->assertAuthenticated();
        $article = Article::where('id', 1)->first();
        $this->get(route('edit.article',$article->id))->assertStatus(200);
    } 

    public function test_user_update_article()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $response = $this->post('/login', ['email' => $user->email, 'password' => 'password']);
        $this->assertAuthenticated();
        $article = Article::where('id', 1)->first();

        $data = [
            'title' => 'Data Engineer', 
            'content' => 'Data engineer adalah seseorang yang bertanggung jawab atas infrastruktur data yang dimiliki oleh sebuah perusahaan. Umumnya, mereka akan bekerja sama dengan karyawan bagian pengolahan data lainnya seperti data analyst dan data manager',
            'image' => 'https://source.unsplash.com/random', 
            'user_id' => '1', 
            'category_id' => '1',
        ];
        $this->post(route('update.article',$article->id), $data)->assertRedirect('/user/articles');
    }

    public function test_user_delete_article()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $response = $this->post('/login', ['email' => $user->email, 'password' => 'password']);
        $this->assertAuthenticated();
        $article = Article::insertGetId([
            'title' => 'Data Engineer', 
            'content' => 'Data engineer adalah seseorang yang bertanggung jawab atas infrastruktur data yang dimiliki oleh sebuah perusahaan. Umumnya, mereka akan bekerja sama dengan karyawan bagian pengolahan data lainnya seperti data analyst dan data manager',
            'image' => 'https://source.unsplash.com/random', 
            'user_id' => '1', 
            'category_id' => '1',
        ]);
        $this->get(route('delete.article',$article))->assertRedirect('/user/articles');
    }
}
