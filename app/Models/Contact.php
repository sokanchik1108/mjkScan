<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;


    public $timestamps = false;


    public function item()
{
    return $this->belongsTo(Item::class);
}

protected $fillable = ['item_id', 'pluses', 'minuses', 'message'];

}
