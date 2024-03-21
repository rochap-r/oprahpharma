<div>
    {{-- Success is as dangerous as failure. --}}

    <div class="row ">
        <div class="card border-0">
            <div
                class="card-header p-2 pb-0 bg-transparent border-0 d-flex align-items-center justify-content-between gap-3 flex-wrap">
                <div class="card-header p-1 pb-0 bg-transparent border-0 d-flex align-items-center justify-content-between gap-3 flex-wrap"
                     style="overflow-x: hidden; width: 100%;">
                    <h4 class="mb-0 text-uppercase">Page de Ventes</h4>
                    <div class="d-flex align-items-center">
                        <a class="btn btn-sm btn-success" href="{{ route('app.order.register') }}">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="icon icon-tabler icon-tabler-baseline-density-small" width="24"
                                 height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                 fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M4 3h16" />
                                <path d="M4 9h16" />
                                <path d="M4 15h16" />
                                <path d="M4 21h16" />
                            </svg>
                            Liste de commandes
                        </a>
                    </div>
                </div>

            </div>


        </div>

    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-xl-9 col-md-9">
                <h2 class="my-3">Recherche Produit</h2>
                <input id="input_search" type="text" class="form-control mb-3" placeholder="Rechercher un produit"
                       wire:model="search">
                <div style="max-height: 200px; overflow-y: auto;overflow-x: hidden; margin: 0">
                    <table class="table table-striped table-responsive m-0">
                        <thead>
                        <tr>
                            <th scope="col">Produit</th>
                            <th scope="col">P V/U</th>
                            <th scope="col">stock</th>
                            <th scope="col">Action</th>
                            <th scope="col"></th>

                        </tr>
                        </thead>
                        <tbody>
                        @isset($products)
                            @foreach ($products as $product)
                                @php
                                    $lastSupply = $product->supplies->last();
                                    $currentStock = $lastSupply ? $lastSupply->quantity_in_stock : 0;
                                    $minimumStockLevel = $product->unit->minimum_stock_level;
                                    $price = $product->unit_price;
                                    $stockStateClass = $currentStock < $minimumStockLevel ? 'text-danger' : 'text-success';
                                @endphp

                                <tr>
                                    <td>
                                        {{ $product->product_name }}|{{ $product->unit->unit_sigle }}
                                    </td>
                                    <td colspan="{{ ($lastSupply && $lastSupply->quantity_in_stock > 0) ? '' : 2  }}">
                                        @if ($price > 0)
                                            {{ number_format($product->unit_price, 0, ',', ' ') }} FC
                                        @else
                                            <span
                                                class="text-danger">{{ number_format($product->unit_price, 0, ',', ' ') }}
                                                    FC</span>
                                        @endif
                                    </td>

                                    <td class="{{ $stockStateClass }}">
                                        {{ $lastSupply ? $lastSupply->quantity_in_stock : 'Indispo' }}
                                    </td>

                                    @if ($lastSupply && $lastSupply->quantity_in_stock > 0)
                                        @if ($price > 0)
                                            <td>
                                                <button class="btn btn-success btn-sm p-1 m-0"
                                                        wire:click.prevent='addProductToCart({{ $product->id }})'>

                                                    <!-- Download SVG icon from http://tabler-icons.io/i/settings -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24"
                                                         height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                         stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M12 5l0 14"></path>
                                                        <path d="M5 12l14 0"></path>
                                                    </svg>
                                                </button>
                                            </td>
                                        @endif
                                    @endif


                                </tr>
                            @endforeach
                        @endisset


                        </tbody>
                    </table>
                </div>


            </div>
            <div class="col-sm-12 col-xl-3 col-md-3">
                <h2 class="my-2">Panier</h2>
                <div class="d-block align-center">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#cart_modal">
                        <div class="alert alert-secondary">
                            <h5 class="text-secondary text-uppercase" id="checkoutModalLabel">
                                {{ $totalProduct }} {{ $totalProduct <= 1 ? 'produit':'produits' }}
                            </h5>
                            <h5 class="text-secondary text-uppercase" id="checkoutModalLabel">
                                {{ number_format($total, 0, ',', ' ') }} FC
                            </h5>
                        </div>
                    </a>
                    <button type="submit" class="btn btn-primary btn-sm align-self-center" wire:click="checkout">Passer la commande</button>
                </div>
            </div>



        </div>
    </div>


    <div class="card-body col-12 overflow-hidden">
        {{-- affichage du rapport --}}
        <hr class="bg-dark">
        <div class="container">
            <div class="row">
                <!-- Carte pour le nombre total de commandes -->
                <div class="col-md-6 col-lg-6 col-sm-12 mb-4">
                    <div class="card text-white bg-primary">
                        <div class="card-body">

                            <h5 class="card-title text-uppercase">NB Cmd du {{ $today }} </h5>

                            <p class="card-text display-5 fw-bold">{{ $totalOrders }} Commandes</p>
                        </div>
                    </div>
                </div>

                <!-- Carte pour le montant total des commandes -->
                <div class="col-md-6 col-lg-6 col-sm-12 mb-4">
                    <div class="card text-white bg-success">
                        <div class="card-body">
                            <h5 class="card-title text-uppercase">Recette du {{ $today }}</h5>
                            <p class="card-text display-5 fw-bold">
                                {{ number_format(round($totalAmount), 0, ',', ' ') }}
                                FC</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Carte pour les 5 dernières commandes -->
            <div class="card mt-2 shadow-lg w-100 col-xl-12 col-md-12 col-sm-12">
                <div class="card-header bg-primary text-white">
                    <h2 class="text-uppercase mx-2 my-0 text-white">Les 5 dernières commandes</h2>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-light">
                        <tr>
                            <th>Vendeur (euse)</th>
                            <th>Date de la commande</th>
                            <th>Prix total</th>
                            <th>Nb Prods</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($recentOrders as $order)
                            <tr data-bs-toggle="collapse" data-bs-target="#order{{ $order->id }}"
                                aria-expanded="false" aria-controls="order{{ $order->id }}">
                                <td>{{ $order->user->lname }} - {{ $order->user->name }}</td>
                                <td>{{ $order->order_date }}</td>
                                <td>{{ number_format(round($order->total_price), 0, ',', ' ') }} FC</td>
                                <td>{{ $order->orderItems->count() }}</td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <div id="order{{ $order->id }}" class="collapse"
                                         aria-labelledby="headingOrder{{ $order->id }}"
                                         data-bs-parent="#order{{ $order->id }}">
                                        <table class="table table-sm table-bordered bg-light m-2 w-80">
                                            <thead>
                                            <tr>
                                                <th>Produit</th>
                                                <th>Qté</th>
                                                <th>Prix de vente</th>
                                                <th>Prix total</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($order->orderItems as $orderItem)
                                                <tr>
                                                    <td>{{ $orderItem->product->product_name }}</td>
                                                    <td>{{ $orderItem->quantity }}</td>
                                                    <td>{{ number_format(round($orderItem->product->unit_price), 0, ',', ' ') }}
                                                        FC
                                                    </td>
                                                    <td>{{ number_format(round($orderItem->line_price), 0, ',', ' ') }}
                                                        FC
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        {{-- Fin code rapport --}}
    </div>





    <!-- Modal -->
    <div wire:ignore.self class="modal modal-blur fade modal-sm" id="checkout_modal" tabindex="-1" aria-hidden="true"
        style="display:none;" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="checkoutModalLabel">
                        @if ($this->product != '')
                            {{ $product->product_name }}
                        @endif
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php
                    if ($this->product) {
                        $lastSupply = $this->product->supplies->last();
                    }

                    ?>
                    <div class="form-group mb-3">
                        <label class="form-label" for="qt">
                                {{ $this->product ? number_format($this->product->unit_price, 0, ',', ' ') : 0 }} FC | STCK MX (<span
                                class="text-success">{{ $this->product ? $lastSupply->quantity_in_stock : 0 }}</span>)
                            | {{ $this->product ? $product->unit->unit_sigle : '' }}
                        </label>

                        <input type="number" min="1"
                               max="{{ $this->product ? $lastSupply->quantity_in_stock : 0 }}" class="form-control"
                               id="quantity{{ $this->product ? $this->product->id : 0 }}" style="width:100%!important;"
                               placeholder="Qté Ex: 50">
                    </div>

                    <button class="btn btn-primary btn-sm"
                            wire:click="addToCart({{ $this->product ? $this->product->id : 0 }}, document.getElementById('quantity{{ $this->product ? $this->product->id : 0 }}').value)">
                        <i class="bi bi-cart-plus-fill"></i> Ajouter
                    </button>
                    <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal" aria-label="Close"
                            wire:click="resetModal"> fermer
                    </button>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal -->
    <div wire:ignore.self class="modal modal-blur fade modal-lg" id="cart_modal" tabindex="-1" aria-hidden="true"
        style="display:none;" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-uppercase text-success" id="checkoutModalLabel">
                        Total à Payer: {{ number_format($total, 0, ',', ' ') }}
                        FC &nbsp;|&nbsp; <span class="badge-soft-success bg-white">
                            {{ $totalProduct }} {{ $totalProduct <= 1 ? 'produit':'produits' }}
                        </span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div style="max-height: 200px; overflow-y: auto; margin: 0">
                        <table class="table table-responsive">
                            <thead>
                            <tr>
                                <th scope="col">Produit</th>
                                <th scope="col">Qté</th>
                                <th  scope="col">Prix total</th>
                                <th  scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $total=0 @endphp
                            @foreach ($cart as $productId => $quantity)
                                @php
                                    $product = \App\Models\Product::find($productId);
                                    $total += $quantity * $product->unit_price;
                                @endphp
                                <tr>
                                    <td>{{ $product->product_name }}</td>
                                    <td>{{ number_format($quantity, 0, ',', ' ') }}
                                        |{{ $product->unit->unit_sigle }}</td>
                                    <td>
                                        {{ number_format($quantity * $product->unit_price, 0, ',', ' ') }}FC
                                    </td>
                                    <td>
                                        <button class="btn btn-danger btn-sm m-0 p-1"
                                                wire:click="removeFromCart({{ $productId }})"
                                                onclick="e.stopPropagation()">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>



                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger me-auto btn-sm"  data-bs-dismiss="modal">fermer</button>
                        <button type="submit" class="btn btn-primary btn-sm" wire:click="checkout">Commander</button>
                    </div>
                </div>

            </div>
        </div>
    </div>


</div>


