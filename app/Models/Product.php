<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
    ];

    //Relationship with new prices
    public function newPrices()
    {
        return $this->hasMany(NewPrice::class, 'product_id');
    }
}
