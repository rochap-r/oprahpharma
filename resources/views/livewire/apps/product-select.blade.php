<div>
    {{-- The best athlete wants his opponent at his best. --}}
    <div class="form-group">
        <div class="row">
            <div class="col-5">
                <input type="text" class="form-control" placeholder="Rechercher un produit..." wire:model="search">

                @if($search && !$product_id)
                    <ul class="list-group">
                        @foreach($products as $product)
                            <li class="list-group-item" wire:click="selectProduct({{ $product->id }})">
                                {{ $product->product_name }} - {{ number_format(round($product->unit_price), 0, ',', ' ') }} FC
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
            <div class="col-7">
                @if($product_id)
                    <div class="selected-product text-uppercase">
                        Produit : {{ $products->find($product_id)->product_name }}sss -
                        {{ number_format(round($products->find($product_id)->unit_price), 0, ',', ' ') }} FC
                        <button type="button" class="btn btn-sm btn-outline-danger " wire:click.prevent="selectProduct(null)">
                            <i class="bi bi-x-circle"></i>
                        </button>
                    </div>
                @endif
            </div>
        </div>



    </div>


</div>
