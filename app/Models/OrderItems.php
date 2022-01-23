<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Product;

class OrderItems extends Model
{
    use HasFactory;


    protected $table = 'order_items';
    protected $fillable = [

        'order_id',
        'prod_id',
        'qty',
        'price',
        
        
    ];

    public function products(): BelongsTo
    {
        return $this->belongsTo(Product::class,'prod_id','id');
    }
}
