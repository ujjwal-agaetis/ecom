<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'address1',
        'address2',
        'state',
        'zip',
        'user_id',
        // Add more columns as needed
    ];
}
