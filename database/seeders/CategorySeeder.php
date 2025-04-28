<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // Добавляем несколько категорий
        Category::create(['name' => 'Потолочные люстры']);
        Category::create(['name' => 'Подвесные люстры']);
        Category::create(['name' => 'Настенные люстры']);
    }
}

