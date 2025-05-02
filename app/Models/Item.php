<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{


    use HasFactory;

    // Таблица товаров
    protected $fillable = [
        'product_name', 'quantity', 'purchase_price', 'sale_price', 'img_path', 'category_id', 'type_id'
    ];

    // Связь с категорией
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Связь с типом товара
    public function type()
    {
        return $this->belongsTo(Type::class);
    }



    public function contacts()
{
    return $this->hasMany(Contact::class);
}


public function averageRating()
{
    $average = $this->contacts()->avg('rating');
    return round($average, 1) ?: 0;
}


public function getFormattedPriceAttribute()
{
    return number_format($this->price, 0, '.', '.') . '₸';
}

}
