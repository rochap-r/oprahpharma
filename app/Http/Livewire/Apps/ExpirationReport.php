<?php

namespace App\Http\Livewire\Apps;

use Livewire\Component;
use App\Models\Product;

class ExpirationReport extends Component
{
    public $products;

    public function mount()
    {
        $this->products = Product::getCriticalProducts();
    }

    public function render()
    {
        return view('livewire.apps.expiration-report');
    }
}
