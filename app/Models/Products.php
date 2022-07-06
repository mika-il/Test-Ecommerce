<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'products';
    protected $fillable = ['name', 'price', 'category_id', 'image'];
    // protected $hidden = ['deleted_at'];

    public function category()
    {
        return $this->belongsTo(ProductCategories::class, 'category_id');
    }

    public function cartItems()
    {
        return $this->hasMany(CartItems::class);
    }

    public function getPriceAttribute($value)
    {
        return number_format($value/100,2);
    }

    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = str_replace('.', '', $value);
    }
}
