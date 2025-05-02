<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    // Таблица типов товаров
    protected $fillable = ['name', 'category_id'];

    // Связь с категорией
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Связь с товарами
    public function items()
    {
        return $this->hasMany(Item::class);
    }
}

