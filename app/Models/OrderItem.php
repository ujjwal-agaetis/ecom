<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $table = 'orderitem';
    protected $fillable = [
        'order_id',
        'item_name',
        'quantity',
        'price',
        'product_id',
        // Add more columns as needed
    ];
}
