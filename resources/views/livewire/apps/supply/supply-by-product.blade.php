<div>
    {{-- Stop trying to control. --}}


    <div class="row ">
        <div class="card border-0 overflow-auto">
            <div
                class="card-header p-5 pb-0 bg-transparent border-0 d-flex align-items-center justify-content-between gap-3 flex-wrap">
                <div
                    class="card-header p-5 pb-0 bg-transparent border-0 d-flex align-items-center justify-content-between gap-3 flex-wrap">
                    <h4 class="mb-0 text-uppercase">Liste d'Approvisionnement relatif à : {{ App\Models\Product::find($productId)->product_name }}</h4>
                    <div class="d-flex align-items-center gap-6">
                        <form class="search-form card-search w-auto flex-shrink-0" action="">
                            <input type="text" name="search" class=" bg-white form-control" placeholder="Search">
                            <button type="submit" class="btn"><img src="assets/img/svg/search.svg" alt=""></button>
                        </form>
                        <a class="btn btn-sm btn-primary" href="{{ route('app.supply.index') }}" >
                            <!-- Download SVG icon from http://tabler-icons.io/i/settings -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24"
                                 height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M12 5l0 14"></path>
                                <path d="M5 12l14 0"></path>
                            </svg>
                            Nouvel Appro
                        </a>

                        <a class="btn btn-sm btn-info pl-2" href="{{ route('app.product.index') }}">
                            <!-- Download SVG icon from http://tabler-icons.io/i/settings -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24"
                                 height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M12 5l0 14"></path>
                                <path d="M5 12l14 0"></path>
                            </svg>
                            Nouveau Produit
                        </a>
                    </div>
                </div>


                <div class="card-body">
                    <div class="table-responsive">
                        <table class="defaultTable text-center w-100">
                            <thead>
                            <tr>
                                <th>N°</th>
                                <th>Produit</th>
                                <th>Prix A/U</th>
                                <th>Qté Stock</th>
                                <th>Date d'achat</th>
                                <th>Date d'exp</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $i=1 @endphp
                            @forelse($supplies as $supply)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $supply->product->product_name }}</td>
                                    <td>{{ number_format(round($supply->unit_purchase_price), 0, ',', ' ') }} FC</td>
                                    <td>{{ $supply->quantity_in_stock }} : {{ $supply->product->unit->unit_sigle }}</td>
                                    <td>{{ \Carbon\Carbon::parse($supply->supply_date)->format('d-m-Y') }}</td>
                                    <td>{{ $supply->expiration_date }}</td>
                                    <td>
                                        <div class="dropdown text-end">
                                            <a href="#" data-bs-toggle="dropdown" class="fs-24 text-gray"
                                               aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </a>
                                            <div class="dropdown-menu p-0" style="">
                                                <a class="dropdown-item" href="{{ route('app.supply.products') }}">Voir plus</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6"><span class="text-danger">Aucune ligne d'approvisionnement disponible</span>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>

                        @if($supplies->count())
                            <div
                                class="mt-5 d-flex justify-content-center justify-content-md-between align-items-center flex-wrap">
                                {{ $supplies->links('livewire::bootstrap') }}
                            </div>
                        @endif
                    </div>
                </div>


            </div>


        </div>

    </div>

</div>

