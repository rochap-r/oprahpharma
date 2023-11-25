<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'order_date', 'order_status', 'total_price'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    //ajouté pour le module du Cart
    public function addProduct(Product $product, $quantity)
    {
        $orderItem = new OrderItem;
        $orderItem->product_id = $product->id;
        $orderItem->quantity = $quantity;
        $orderItem->line_price = $product->unit_price * $quantity;

        $this->orderItems()->save($orderItem);

        // Décrémenter le stock
        $product->decrementStock($quantity);
    }

    public function placeOrder()
    {
        // Vous pouvez ajouter ici toute logique supplémentaire nécessaire pour passer la commande
        // Par exemple, vous pouvez définir le statut de la commande sur 'passée'
        $this->order_status = 'passée';
        $this->save();
    }


}
