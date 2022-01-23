<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'carts';
    protected $fillable = [

        'user_id',
        'prod_id',
        'user_qty',

    ];
  //here remove products id (prod_id)...and add Products name....like id 1 remove and iphone11 added
  public function products()
  {
      return $this->belongsTo(Product::class, 'prod_id', 'id');
  }
}
