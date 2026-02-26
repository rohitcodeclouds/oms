<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Category;
use App\Models\ProductImage;


class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'product_name',
        'description',
        'price',
        'stock',
        'category_id',
        'sku',
        'weight',
        'dimension',
        'is_active'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}
