<div>
    {{-- Success is as dangerous as failure. --}}

    <div class="row ">
        <div class="card border-0 overflow-auto">
            <div
                class="card-header p-5 pb-0 bg-transparent border-0 d-flex align-items-center justify-content-between gap-3 flex-wrap">
                <div
                    class="card-header p-5 pb-0 bg-transparent border-0 d-flex align-items-center justify-content-between gap-3 flex-wrap">
                    <h4 class="mb-0 text-uppercase">Liste des commandes</h4>
                    <div class="d-flex align-items-center gap-6">
                        <form class="search-form card-search w-auto flex-shrink-0" action="">
                            <input type="text" name="search" class=" bg-white form-control" placeholder="Search">
                            <button type="submit" class="btn"><img src="{{asset('assets/img/svg/search.svg')}}" alt="">
                            </button>
                        </form>
                        <a class="btn btn-sm btn-primary" href="#" data-bs-toggle="modal"
                           data-bs-target="#checkout_modal">
                            <!-- Download SVG icon from http://tabler-icons.io/i/settings -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24"
                                 height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M12 5l0 14"></path>
                                <path d="M5 12l14 0"></path>
                            </svg>
                            Nouvelle commande
                        </a>
                    </div>
                </div>


                <div class="card-body">
                    {{--affichage du rapport--}}
                    <hr class="bg-dark">
                    <div class="container ">
                        <div class="row">
                            <!-- Carte pour le nombre total de commandes -->
                            <div class="col-md-6 col-lg-6 mb-4">
                                <div class="card text-white bg-primary">
                                    <div class="card-body">
                                        <h5 class="card-title text-uppercase">nb Cmd du {{ date('d/m/Y') }}  </h5>
                                        <p class="card-text display-5 fw-bold">{{ $totalOrders }} Commandes</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Carte pour le montant total des commandes -->
                            <div class="col-md-6 col-lg-6 mb-4">
                                <div class="card text-white bg-success">
                                    <div class="card-body">
                                        <h5 class="card-title text-uppercase">Recette du {{ date('d/m/Y') }}</h5>
                                        <p class="card-text display-5 fw-bold">{{ number_format(round($totalAmount), 0, ',', ' ') }}
                                            FC</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Carte pour les 5 dernières commandes -->
                        <div class="card mt-2 shadow-lg w-100">
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
                                    @foreach($recentOrders as $order)
                                        <tr data-bs-toggle="collapse" data-bs-target="#order{{$order->id}}" aria-expanded="false" aria-controls="order{{$order->id}}">
                                            <td>{{ $order->user->lname }} - {{ $order->user->name }}</td>
                                            <td>{{ $order->order_date }}</td>
                                            <td>{{ number_format(round($order->total_price), 0, ',', ' ') }} FC</td>
                                            <td>{{ $order->orderItems->count() }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">
                                                <div id="order{{$order->id}}" class="collapse" aria-labelledby="headingOrder{{$order->id}}" data-bs-parent="#order{{$order->id}}">
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
                                                        @foreach($order->orderItems as $orderItem)
                                                            <tr>
                                                                <td>{{ $orderItem->product->product_name }}</td>
                                                                <td>{{ $orderItem->quantity }}</td>
                                                                <td>{{ number_format(round($orderItem->product->unit_price), 0, ',', ' ') }} FC</td>
                                                                <td>{{ number_format(round($orderItem->line_price), 0, ',', ' ') }} FC</td>
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
                    {{--Fin code rapport--}}
                </div>

            </div>


        </div>

    </div>


    <!-- Modal -->
    <div wire:ignore.self class="modal modal-xl fade" id="checkout_modal" tabindex="-1"
         aria-labelledby="checkoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="checkoutModalLabel">Passer la commande</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Ici, vous pouvez ajouter le contenu de votre boîte modale. Par exemple, un formulaire pour passer la commande. -->
                    <div class="container pb-1">
                        <div class="row">
                            <div class="col-6">
                                <h2 class="my-3">Produits</h2>
                                <input id="input_search" type="text" class="form-control mb-3"
                                       placeholder="Rechercher un produit"
                                       wire:model="search">
                                <div style="max-height: 200px; overflow-y: auto;">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">Produit</th>
                                            <th scope="col">P V/U</th>
                                            <th scope="col">stock</th>
                                            <th scope="col">Qté</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($products as $product)
                                            <tr>
                                                <td>{{ $product->product_name }}</td>
                                                <td>{{ number_format($product->unit_price, 0, ',', ' ') }} FC</td>
                                                <td>{{ $product->supplies->last() ? $product->supplies->last()->quantity_in_stock : 'Non disponible' }}</td>
                                                <td>
                                                    <input type="number" min="1"
                                                           max="{{ $product->supplies->last() ? $product->supplies->last()->quantity_in_stock : 0 }}"
                                                           class="form-control" id="quantity{{ $product->id }}">
                                                </td>
                                                <td>
                                                    <button class="btn btn-primary btn-sm"
                                                            wire:click="addToCart({{ $product->id }}, document.getElementById('quantity{{ $product->id }}').value)">
                                                        <i class="bi bi-cart-plus-fill"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>


                            </div>
                            <div class="col-6">
                                <h2 class="my-2">Panier</h2>
                                <div class="alert alert-success">
                                    <h3 class="text-success">Total à Payer: {{ number_format($total, 0, ',', ' ') }}
                                        FC</h3>
                                </div>

                                <div style="max-height: 200px; overflow-y: auto;">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">Produit</th>
                                            <th scope="col">Qté</th>
                                            <th scope="col">Prix total</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $total=0 @endphp
                                        @foreach ($cart as $productId => $quantity)
                                            @php
                                                $product = \App\Models\Product::find($productId);
                                                $total+=$quantity * $product->unit_price;
                                            @endphp
                                            <tr>
                                                <td>{{ $product->product_name }}</td>
                                                <td>{{ number_format($quantity, 0, ',', ' ') }} {{ $product->unit->unit_sigle  }}</td>
                                                <td>{{ number_format($quantity * $product->unit_price, 0, ',', ' ') }}FC
                                                </td>
                                                <td>
                                                    <button class="btn  btn-danger btn-sm"
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
                            </div>

                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="resetModal">
                        Fermer
                    </button>

                    <button class="btn btn-success" wire:click="checkout">Passer la commande</button>
                </div>

            </div>
        </div>
    </div>


</div>
