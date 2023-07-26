<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewPrice extends Model
{
    use HasFactory;
    protected $table = 'newprices';

    protected $fillable = [
        'user_id',
        'product_id',
        'newprice',
    ];

     //Relationship with products
     public function product()
     {
         return $this->belongsTo(Product::class, 'product_id');
     }
 
     //Relationship with users
     public function user()
     {
         return $this->belongsTo(User::class, 'user_id');
     }
}
