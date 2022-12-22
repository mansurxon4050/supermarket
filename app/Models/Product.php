<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'image',
        'id',
        'name',
        'star',
        'info',
        'description',
        'category',
        'type' ,
        'price',
        'discount',
        'discount_price',
        'count'

    ];
}
