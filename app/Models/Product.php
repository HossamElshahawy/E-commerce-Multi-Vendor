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

    public function brand()
    {
        return $this->belongsTo(brand::class,'brand_id','id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function relatedProducts()
    {
        return $this->hasMany(Product::class,'category_id','category_id')->where('status','active')->limit(3);
    }
    static public function getProductByCart($id)
    {
        return self::where('id',$id)->get()->toArray();
    }
}
