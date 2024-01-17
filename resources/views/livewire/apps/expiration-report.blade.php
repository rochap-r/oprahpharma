<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="display-5">Rapport d'expiration des produits en stock</h1>
        </div>

        <div class="table-responsive mt-4">
            <table class="table table-striped table-hover">
                <thead class="thead-light">
                <tr>
                    <th>Nom du produit</th>
                    <th>Description</th>
                    <th>Nombre Appros</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr data-bs-toggle="collapse" data-bs-target="#product{{ $product->id }}" aria-expanded="false" aria-controls="product{{ $product->id }}">
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->product_description }}</td>
                        <td class="text-danger text-uppercase">{{ $product->getExpiringSupplies()->count() }} {{ $product->getExpiringSupplies()->count()<=1?"Appro":"Appros" }}</td>
                    </tr>
                    <tr id="product{{ $product->id }}" class="collapse">
                        <td colspan="3">
                            <div class="table-responsive mt-2">
                                <table class="table table-sm table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Date d'expiration</th>
                                        <th>Quantité en stock</th>
                                        <th>État</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($product->getExpiringSupplies() as $supply)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($supply->expiration_date)->format('d/m/Y') }}</td>
                                            <td>{{ $supply->quantity_in_stock>=$supply->quantity_purchased?$supply->quantity_purchased: $supply->quantity_in_stock}}</td>
                                            <td>
                                                @if(Carbon\Carbon::now()->diffInDays($supply->expiration_date, false) <= 30)
                                                    <span class="badge bg-danger">Critique</span>
                                                @else
                                                    <span class="badge bg-info">Proche de l'expiration</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                    <tr style="background-color: white!important;"><td colspan="3"> </td></tr> <!-- Ligne vide pour l'espace -->
                @endforeach

                </tbody>
            </table>
        </div>
    </div>




</div>
