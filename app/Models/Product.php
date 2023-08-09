<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'status',
        'quantity',
        'stock',
        'price',
        'img',
        'category_id',
        // Add more columns as needed
        
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

}
