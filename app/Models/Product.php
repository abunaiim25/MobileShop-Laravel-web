<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    //for database save
    protected $table = 'products';
    protected $fillable = [

        'cate_id',
        'name',
        'slug',
        'small_description',
        'description',
        'original_price',
        'selling_price',
        'image',
        'qty',
        'tax',
        'status',
        'trending',
        'meta_title',
        'meta_keywords',
        'meta_description',
    ];

    //here remove category id (cate_id)...and add category name....like id 1 remove and iphone11 added
    public function category()
    {
        return $this->belongsTo(Category::class, 'cate_id', 'id');
    }
}
