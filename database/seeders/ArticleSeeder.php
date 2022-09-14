<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    public function run()
    {
        Article::create([
            'title' => 'Frontend Dev',
            'content' => 'Bagian front-end dari sebuah website adalah bagian yang langsung dilihat oleh user. User juga bisa langsung berinteraksi pada bagian ini. Bagian ini dibangun menggunakan HTML, CSS, dan JavaScript.',
            'image' => 'https://source.unsplash.com/random',
            'user_id' => '1',
            'category_id' => '1',
        ]);

        Article::create([
            'title' => 'Backend Dev',
            'content' => 'Back-end adalah bagian belakang layar dari sebuah website. Bahasa pemograman untuk back-end development diantaranya adalah PHP, Ruby, Python, dan banyak lainnya.',
            'image' => 'https://source.unsplash.com/random',
            'user_id' => '1',
            'category_id' => '1',
        ]);

        Article::create([
            'title' => 'Fullstack Dev',
            'content' => 'Full-stack developer bekerja pada bagian front-end dan back-end. Mereka menguasai HTML, CSS, JavaScript, dan satu atau lebih bahasa pemograman back-end.',
            'image' => 'https://source.unsplash.com/random',
            'user_id' => '1',
            'category_id' => '1',
        ]);
    }
}
