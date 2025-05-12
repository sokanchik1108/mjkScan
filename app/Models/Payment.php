<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

protected $fillable = [
    'name', 'phone', 'cart',
    'payment_status', 'delivery_status'
];

}
