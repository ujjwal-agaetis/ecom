<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    use HasFactory;
    
    protected $fillable = [
        'category_name',
        // Add more columns as needed
        
    ];

    public function products()
    {
        return $this->hasMany(Product::class,'category_id');
    }
}
