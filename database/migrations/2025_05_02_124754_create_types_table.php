<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypesTable extends Migration
{
    public function up()
    {
        Schema::create('types', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Название типа товара
            $table->foreignId('category_id')  // Связь с категорией
                ->constrained('categories')  // Ссылаемся на таблицу categories
                ->onDelete('cascade');  // При удалении категории удаляются все связанные типы
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('types');
        Schema::enableForeignKeyConstraints();
    }
    
}
