<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supply extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'quantity_purchased',
        'unit_purchase_price',
        'supply_date',
        'quantity_in_stock',
        'expiration_date',
        'supply_status'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function journals()
    {
        return $this->hasMany(Journal::class);
    }

    //ajouté pour le module du Cart
    public function scopeFifo($query)
    {
        return $query->orderBy('supply_date');
    }

    //ajouté pour le module du Cart
    public function decrementStock($quantity)
    {
        return $this->decrement('quantity_in_stock', $quantity);
    }

}
