<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // Добавляем несколько категорий
        Category::create(['name' => 'Люстры']);
        Category::create(['name' => 'Светильники']);
        Category::create(['name' => 'Розетки']);
    }
}


