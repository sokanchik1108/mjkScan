<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Type;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    public function run()
    {

        // Пример категорий и типов для каждой категории
        $categories = Category::all(); // Загружаем все категории

        foreach ($categories as $category) {
            // Заполняем типами товаров для каждой категории
            if ($category->name == 'Люстры') {
                Type::create([
                    'name' => 'Подвесные',
                    'category_id' => $category->id,
                ]);
                Type::create([
                    'name' => 'Настенные',
                    'category_id' => $category->id,
                ]);
            } 

            // Добавьте дополнительные условия для других категорий
            elseif ($category->name == 'Светильники') {
                Type::create([
                    'name' => 'мебельные',
                    'category_id' => $category->id,
                ]);
                Type::create([
                    'name' => 'Встариваемые',
                    'category_id' => $category->id,
                ]);
                Type::create([
                    'name' => 'Подвесные',
                    'category_id' => $category->id,
                ]);
                Type::create([
                    'name' => 'Настенные',
                    'category_id' => $category->id,
                ]);
            }

            elseif ($category->name == 'Настольные лампы') {
                Type::create([
                    'name' => 'Светодиодные',
                    'category_id' => $category->id,
                ]);
                Type::create([
                    'name' => 'Галогенные',
                    'category_id' => $category->id,
                ]);
                Type::create([
                    'name' => 'Технические',
                    'category_id' => $category->id,
                ]);
            }

            elseif ($category->name == 'Лампочки') {
                Type::create([
                    'name' => 'Декоративные',
                    'category_id' => $category->id,
                ]);
                Type::create([
                    'name' => 'Настольные',
                    'category_id' => $category->id,
                ]);
            }

            elseif ($category->name == 'Уличное освещение') {
                Type::create([
                    'name' => 'Уличные',
                    'category_id' => $category->id,
                ]);
                Type::create([
                    'name' => 'Подводные',
                    'category_id' => $category->id,
                ]);
            }
        }
    }
}


