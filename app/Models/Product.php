<?php

namespace App\Models;

use App\Models\Supply;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['product_name', 'product_description','unit_price','unit_id'];

    public function orderItems(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function unit(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    public function supplies(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Supply::class);
    }
    /*
     * code lié au StockReport Liv
     */
    public function calculateStockStatus(): string
    {
        $latestSupply = $this->supplies()->latest()->first();
        return !$latestSupply || $latestSupply->quantity_in_stock <= $this->unit->minimum_stock_level
            ? 'critical' : 'normal';
    }

    //ajouté pour le module du Cart
    public function scopeFifo($query)
    {
        return $query->orderBy('supply_date');
    }


    public function search($productName)
    {
        return $this->where('product_name', 'like', "%{$productName}%")->get();
    }

    //Instruction d'expiration des produits en stock
    public function getExpiringSupplies(): \Illuminate\Database\Eloquent\Collection
    {
        $oneMonthFromNow = Carbon::now()->addMonth();

        return $this->supplies()
            ->where('expiration_date', '<=', $oneMonthFromNow)
            ->where('quantity_in_stock','<>',0)
            ->orderBy('expiration_date','DESC') // FIFO
            ->get();
    }

    public static function getCriticalProducts(): \Illuminate\Database\Eloquent\Collection
    {
        $oneMonthFromNow = Carbon::now()->addMonth();

        return self::whereHas('supplies', function ($query) use ($oneMonthFromNow) {
            $query->where('expiration_date', '<=', $oneMonthFromNow)
            ->where('quantity_in_stock','<>',0);
        })->get();
    }

}
