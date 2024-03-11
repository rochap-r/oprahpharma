<?php

namespace App\Http\Livewire\Apps;

use DateTimeZone;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Journal;
use App\Models\Product;
use Livewire\Component;
use App\Models\OrderItem;
use App\Models\OrderJournal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Checkout extends Component
{

    public $cart = [];
    public $search = '';

    public $total = 0;

    public $product='';

    public $errorMessage = '';

    public $totalOrders;
    public $totalAmount;
    public $recentOrders;

    public $isOpen = false;



    protected $listeners = [
        'resetForm',
        'refreshCart' => '$refresh',
        'quantity-error' => 'handleQuantityError',
        'quantity-error-checkout ' => 'handleQuantityError',
        'quantity-error-empty ' => 'handleQuantityError',
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
        //dd($this->totalOrders);
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
            if (empty($quantity)) {
                // Émettez un événement Livewire pour déclencher l'alerte JavaScript lorsque le stock est < à la qté spécifiée
                $this->dispatchBrowserEvent('quantity-error-empty', [
                    'quantity' => 0,
                ]);
            } else {
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
                    $this->dispatchBrowserEvent('hideCheckoutModal');
                }
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
                $this->updateOrderJournal($order);
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
                'supply_date' => $orderItem->order->order_date,
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

    private function updateOrderJournal($order)
    {
        foreach ($order->orderItems as $orderItem)
            // Create a new Journal
            OrderJournal::create([
                'order_item_id' => $orderItem->id,
                'quantity' => $orderItem->quantity,
                'line_price' => $orderItem->line_price,
                'order_date' => $order->order_date,
            ]);
    }

    public function addProductToCart(int $id)
    {
        $this->product = Product::findOrFail($id);
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('showCheckoutModal');
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


    public function render()
    {
        $products = [];

        $this->updateData();

        if (!empty($this->search)) {

            $products = Product::where('product_name', 'like', "%{$this->search}%")
                ->with(['supplies' => function ($query) {
                    $query->where('quantity_in_stock', '>=', 0)
                        ->orderBy('supply_date', 'desc');
                }, 'unit'])
                ->get();
        }
        $today = Carbon::now('Africa/Lubumbashi')->format('d-m-Y');

        return view('livewire.apps.checkout', [
            'products' => $products,
            'totalOrders' => $this->totalOrders,
            'totalAmount' => $this->totalAmount,
            'recentOrders' => $this->recentOrders,
            'today' => $today,
        ]);
    }
}
