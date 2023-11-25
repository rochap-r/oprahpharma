<?php

namespace App\Http\Livewire\Apps;

use App\Models\Journal;
use Carbon\Carbon;
use DateTimeZone;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Supply;

class Cart extends Component
{

    public $cart = [];
    public $search = '';

    public $total = 0;

    public $errorMessage = '';

    public $totalOrders;
    public $totalAmount;
    public $recentOrders;


    protected $listeners = [
        'resetForm',
        'refreshCart' => '$refresh',
        'quantity-error' => 'handleQuantityError',
        'quantity-error-checkout ' => 'handleQuantityError',
    ];

    public function mount()
    {
        //no action
    }


    private function updateData()
    {
        $user = Auth::user();
        $today = Carbon::now('Africa/Lubumbashi')->format('Y-m-d');

        $this->totalOrders = Order::where('user_id', $user->id)
            ->whereDate('order_date', $today)
            ->count();

        $this->totalAmount = Order::where('user_id', $user->id)
            ->whereDate('order_date', $today)
            ->sum('total_price');


        $this->recentOrders = Order::where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();
    }


    public function addToCart($productId, $quantity)
    {
        $product = Product::find($productId);

        if ($product) {
            if ($quantity > $product->supplies->last()->quantity_in_stock) {
                // Émettez un événement Livewire pour déclencher l'alerte JavaScript lorsque le stock est < à la qté spécifiée
                $this->dispatchBrowserEvent('quantity-error', [
                    'quantity' => $quantity, 'quantityInStock' => $product->supplies->last()->quantity_in_stock
                ]);
            } else {
                if (isset($this->cart[$product->id])) {
                    $this->cart[$product->id] += $quantity;
                } else {
                    $this->cart[$product->id] = $quantity;
                }

                $this->total += $quantity * $product->unit_price;
                $this->search = null;
            }
        }
    }


    public function handleQuantityError()
    {
        $this->errorMessage = 'La quantité spécifiée est supérieure à la quantité en stock';
    }


    public function showToastr($message, $type)
    {
        return $this->dispatchBrowserEvent('showToastr', [
            'type' => $type,
            'message' => $message
        ]);
    }

    public function removeFromCart($productId)
    {
        if (isset($this->cart[$productId])) {
            $product = Product::find($productId);
            if ($product) {
                // Mettre à jour le total
                $this->total -= $this->cart[$productId] * $product->unit_price;
            }

            // Supprimer le produit du panier
            unset($this->cart[$productId]);
        }
    }


    public function resetModal()
    {
        $this->reset(); // Cela réinitialisera toutes les propriétés publiques à leur valeur initiale.
    }


    //les fonctions liées à checkout

    public function checkout()
    {
        if (!empty($this->cart)) {
            DB::transaction(function () {
                $order = $this->createOrder();
                $totalPrice = $this->createOrderItems($order);
                $this->updateOrderTotalPrice($order, $totalPrice);
                $this->clearCart();
                $this->showSuccessMessage();
            });
        } else {
            // Émettez un événement Livewire pour déclencher l'alerte JavaScript lorsque le stock est < à la qté spécifiée
            $this->dispatchBrowserEvent('quantity-error-checkout', [
                'quantity' => 0,
            ]);
        }

        $this->total = 0;
        // Émettre l'événement de rafraîchissement
        $this->emit('updateCart');
    }

    private function createOrder()
    {
        return Order::create([
            'user_id' => auth()->id(),
            'order_date' => Carbon::now(new DateTimeZone('Africa/Lubumbashi'))
        ]);
    }

    private function createOrderItems($order)
    {
        $totalPrice = 0;

        foreach ($this->cart as $productId => $quantity) {
            $product = Product::find($productId);

            if ($product) {
                $orderItem = $this->createOrderItem($product, $quantity);
                $order->orderItems()->save($orderItem);
                $totalPrice += $orderItem->line_price;

                $this->updateProductSupplies($product, $quantity, $orderItem);
            }
        }

        return $totalPrice;
    }

    private function createOrderItem($product, $quantity)
    {
        return new OrderItem([
            'product_id' => $product->id,
            'quantity' => $quantity,
            'line_price' => $product->unit_price * $quantity,
        ]);
    }

    private function updateProductSupplies($product, $quantity, $orderItem)
    {
        $supplies = $product->supplies()->orderBy('supply_date')->get();
        foreach ($supplies as $supply) {
            $decrementQuantity = min($supply->quantity_in_stock, $quantity);
            $supply->decrement('quantity_in_stock', $decrementQuantity);

            // Update the quantity_in_stock of subsequent supplies
            $subsequentSupplies = $product->supplies()->where('id', '>', $supply->id)->get();
            foreach ($subsequentSupplies as $subsequentSupply) {
                $subsequentSupply->decrement('quantity_in_stock', $decrementQuantity);
            }

            // Create a new Journal
            Journal::create([
                'order_item_id' => $orderItem->id,
                'supply_id' => $supply->id,
                'quantity' => $decrementQuantity,
                'unit_purchase_price' => $supply->unit_purchase_price,
                'supply_date' => $supply->supply_date,
            ]);

            $quantity -= $decrementQuantity;
            if ($quantity == 0) {
                break;
            }

            // If the supply is exhausted, mark it as such
            if ($supply->quantity_in_stock == 0) {
                $supply->supply_status = true;
                $supply->save();
            }
        }
    }


    private function updateOrderTotalPrice($order, $totalPrice)
    {
        $order->update([
            'total_price' => $totalPrice
        ]);
    }

    private function clearCart()
    {
        $this->cart = [];
    }

    private function showSuccessMessage()
    {
        $this->dispatchBrowserEvent('showToastr', [
            'type' => 'success',
            'message' => 'La commande a été effectuée avec avec succès !'
        ]);

        $this->dispatchBrowserEvent('hideCheckoutModal');
    }


    //fin de ses fonctons

    public function render()
    {
        $products = [];

        $this->updateData();

        if (!empty($this->search)) {

            $products = Product::where('product_name', 'like', "%{$this->search}%")
                ->whereHas('supplies', function ($query) {
                    $query->where('quantity_in_stock', '>', 0);
                })
                ->with(['supplies' => function ($query) {
                    $query->where('quantity_in_stock', '>', 0)
                        ->orderBy('supply_date', 'desc');
                }])
                ->get();
        }

        return view('livewire.apps.orders.cart', [
            'products' => $products,
            'totalOrders' => $this->totalOrders,
            'totalAmount' => $this->totalAmount,
            'recentOrders' => $this->recentOrders,
        ]);
    }
}
