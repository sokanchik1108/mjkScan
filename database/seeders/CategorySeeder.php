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
        Category::create(['name' => 'Настольные лампы']);
        Category::create(['name' => 'Торшеры']);
        Category::create(['name' => 'Лампочки']);
        Category::create(['name' => 'Споты']);
        Category::create(['name' => 'Офисное освищение']);
        Category::create(['name' => 'Светодиодная подсветка']);
    }
}


