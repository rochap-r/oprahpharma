<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
    use HasFactory;
    protected $fillable = ['order_id', 'product_id', 'quantity', 'line_price','stock_status'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function journal()
    {
        return $this->hasOne(Journal::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
