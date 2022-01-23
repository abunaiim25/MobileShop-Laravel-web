<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $table = 'wishlists';
    protected $fillable = [

        'user_id',
        'prod_id',

    ];

     //here remove products id (prod_id)...and add Products name....like id 1 remove and iphone11 added
  public function products()
  {
      return $this->belongsTo(Product::class, 'prod_id', 'id');
  }
}
