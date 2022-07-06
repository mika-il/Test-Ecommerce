<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItems extends Model
{
    use HasFactory;

    protected $table = 'cart_items';
    protected $fillable = ['product_id'];

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }
}
