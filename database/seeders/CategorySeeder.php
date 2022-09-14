<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::create([
            'name' => 'Technolgy',
            'user_id' => '1',
        ]);
        Category::create([
            'name' => 'Politics',
            'user_id' => '2',
        ]);
        Category::create([
            'name' => 'Economy',
            'user_id' => '1',
        ]);
    }
}
