<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_item_id',
        'supply_id',
        'quantity',
        'unit_purchase_price',
        'supply_date',
    ];

    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class);
    }

    public function supply()
    {
        return $this->belongsTo(Supply::class);
    }
}
