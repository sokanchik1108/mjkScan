<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{

    public function contacts()
{
    return $this->hasMany(Contact::class);
}

    // Связь с категорией
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected $fillable = ['name', 'price', 'category_id' ,];


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
