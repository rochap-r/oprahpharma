//bard
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-light text-center">
                    <h3 class="mb-0">Rapport d'expiration des produits en stock</h3>
                    <button class="btn btn-sm btn-primary float-end" id="export-pdf">Exporter en PDF</button>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Nom du produit</th>
                            <th scope="col">Description</th>
                            <th scope="col">Date d'expiration</th>
                            <th scope="col">État</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            @foreach($product->getExpiringSupplies() as $supply)
                                <tr>
                                    <td>{{ $product->product_name }}</td>
                                    <td>{{ $product->product_description }}</td>
                                    <td>{{ \Carbon\Carbon::parse($supply->expiration_date)->format('d/m/Y') }}</td>
                                    <td>
                                        @if(Carbon\Carbon::now()->diffInDays($supply->expiration_date, false) <= 30)
                                            <span class="badge bg-danger text-white">Critique</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Proche de l'expiration</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
