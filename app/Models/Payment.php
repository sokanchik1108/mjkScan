<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

protected $fillable = [
    'name', 'phone', 'address', 'card_number', 'cart',
    'payment_status', 'delivery_status'
];

}
