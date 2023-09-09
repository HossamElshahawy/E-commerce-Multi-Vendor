<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'summary',
        'description',
        'stock',
        'size',
        'brand_id',
        'category_id',
        'child_category_id',
        'photo',
        'price',
        'offer_price',
        'discount',
        'condition',
        'vendor_id',
        'status',

    ];
}
