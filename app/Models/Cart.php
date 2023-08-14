<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Cart extends Model
{
    use HasFactory;
    protected $table = 'cart';
    protected $fillable = [
        'item_name',
        'quantity',
        'price',
        'order_id',
        // Add more columns as needed
    ];
}