<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name']; // Для массового присваивания

    // Связь с товарами
    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
