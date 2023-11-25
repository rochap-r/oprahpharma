<div>
    {{-- Stop trying to control. --}}


    <div class="row ">
        <div class="card border-0 overflow-auto">
            <div
                class="card-header p-5 pb-0 bg-transparent border-0 d-flex align-items-center justify-content-between gap-3 flex-wrap">
                <div
                    class="card-header p-5 pb-0 bg-transparent border-0 d-flex align-items-center justify-content-between gap-3 flex-wrap">
                    <h4 class="mb-0 text-uppercase">Liste d'Approvisionnement</h4>
                    <div class="d-flex align-items-center gap-6">
                        <form class="search-form card-search w-auto flex-shrink-0" action="">
                            <input type="text" name="search" class=" bg-white form-control" placeholder="Search">
                            <button type="submit" class="btn"><img src="{{ asset('assets/img/svg/search.svg') }}" alt=""></button>
                        </form>
                        <a class="btn btn-sm btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#supply_modal">
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

                        <a class="btn btn-sm btn-secondary pl-2" href="{{ route('app.supply.products') }}">
                            <!-- Download SVG icon from http://tabler-icons.io/i/settings -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-home-2"
                                 width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                 fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M5 12l-2 0l9 -9l9 9l-2 0"></path>
                                <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path>
                                <path d="M10 12h4v4h-4z"></path>
                            </svg>

                            Details Appros
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
                                    <td>{{ $supply->product_name }}</td>
                                    <td>{{ number_format(round($supply->unit_purchase_price), 0, ',', ' ') }} FC</td>
                                    <td>{{ $supply->quantity_in_stock }} : {{ $supply->unit_sigle }}</td>
                                    <td>{{ \Carbon\Carbon::parse($supply->supply_date)->format('d-m-Y') }}</td>
                                    <td>{{ $supply->expiration_date }}</td>
                                    <td>
                                        <div class="dropdown text-end">
                                            <a href="#" data-bs-toggle="dropdown" class="fs-24 text-gray"
                                               aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </a>
                                            <div class="dropdown-menu p-0" style="">
                                                <a class="dropdown-item" href="{{ route('app.supply.product',$supply->product_id) }}">Par Produit</a>
                                                <a class="dropdown-item"
                                                   wire:click.prevent='editSupply({{ $supply->id }})' href="#">Edit</a>
                                                <a class="dropdown-item"
                                                   wire:click.prevent="deleteSupply({{ $supply->id }})"
                                                   href="#">Delete</a>
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


    <!-- model de creation et mise à jour des categories !-->
    <div wire:ignore.self class="modal modal-blur fade modal-lg" id="supply_modal" tabindex="-1" aria-hidden="true"
         style="display: none;"
         data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form class="modal-content" method="POST"
                  @if($updateSupplyMode) wire:submit.prevent='updateSupply()'
                  @else wire:submit.prevent='addSupply()' @endif >

                <div class="modal-header">
                    <h5 class="modal-title">{{ $updateSupplyMode? "Mise à jour de la ligne d'approvisionnement N° ".$selected_id."":'Création d\'une nouvelle ligne d\'approvisionnement' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf

                    @if($updateSupplyMode===true)

                        <input type="hidden" wire:model='selected_id'>
                    @endif


                    <div class="form-group">
                        <label for="product_id">Produit</label>
                        <select name="product_id" id="product_id" class="form-control" wire:model="product_id">
                            <option value="">Sélectionner un produit</option>
                            @foreach(App\Models\Product::orderBy('product_name','asc')->select([
                                'id','product_name','unit_price'])->get() as $product)
                                <option value="{{ $product->id }}">{{ $product->product_name }}   {{ number_format(round($product->unit_price), 0, ',', ' ') }} FC</option>
                            @endforeach
                        </select>

                        <span class="text-danger">@error('product_id'){{ $message }}@enderror</span>
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label" for="unit_purchase_price">Prix d'achat unitaire</label>
                                <input type="number" class="form-control" id="unit_purchase_price"
                                       name="unit_purchase_price"
                                       wire:model='unit_purchase_price'
                                       placeholder="Saisissez le prix d'achat unitaire">
                                <span class="text-danger">@error('unit_purchase_price'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label" for="quantity_purchased">Quantité achetée</label>
                                <input type="number" class="form-control" id="quantity_purchased"
                                       name="quantity_purchased"
                                       wire:model='quantity_purchased' placeholder="Saisissez la quantité achetée">
                                <span class="text-danger">@error('quantity_purchased'){{ $message }}@enderror</span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label" for="supply_date">Date d'achat</label>
                                <input type="date" class="form-control" id="supply_date" name="supply_date"
                                       wire:model='supply_date'>
                                <span class="text-danger">@error('supply_date'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label" for="expiration_date">Date d'expiration</label>
                                <input type="date" class="form-control" id="expiration_date" name="expiration_date"
                                       wire:model='expiration_date'>
                                <span class="text-danger">@error('expiration_date'){{ $message }}@enderror</span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit"
                            class="btn btn-primary">{{ $updateSupplyMode? 'Mettre à jour':'Enregistrer' }}</button>
                </div>
            </form>
        </div>
    </div>


</div>
