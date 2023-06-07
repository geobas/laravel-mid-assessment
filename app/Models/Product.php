<?php

namespace App\Models;

use App\Models\CartItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', // product's name
        'slug', // product's slug to form the url
        'sku', // product's Stock Keeping Unit for tracking
        'short_description', // a summary description of product
        'description', // a full description of product
        'price', // product's price
        'stock', // product's quantity
    ];

    /**
     * A Product has many CartItems.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }
}
