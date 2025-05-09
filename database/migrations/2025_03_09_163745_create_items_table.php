<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id('id');
            $table->string('product_name');
            $table->unsignedInteger('quantity');
            $table->string('purchase_price');
            $table->decimal('sale_price', 10, 2);
            $table->string('img_path');
            $table->string('qrcode_path')->nullable();
            $table->string('article')->nullable();  // Если столбец может быть пустым
            $table->string('brand')->nullable();  // Если столбец может быть пустым
            $table->string('power')->nullable();  // Если столбец может быть пустым
            $table->string('madein')->nullable();  // Если столбец может быть пустым
            $table->string('basetype')->nullable();  // Если столбец может быть пустым
            $table->text('description')->nullable();  // Если столбец может быть пустым
            $table->text('detailed')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->unsignedBigInteger('type_id')->nullable();
            $table->foreign('type_id')->references('id')->on('types')->onDelete('cascade');
            $table->timestamps();
        });           
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('items');
        Schema::enableForeignKeyConstraints();
    }
    
};
