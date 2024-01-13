<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderJournal extends Model
{
    use HasFactory;
    protected $fillable=[
        'order_item_id',
        'quantity',
        'line_price',
        'order_date',
        ];

    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class);
    }
}
