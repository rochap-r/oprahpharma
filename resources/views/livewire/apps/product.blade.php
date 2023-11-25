<div>
    {{-- The whole world belongs to you. --}}

    <div class="row ">
        <div class="card border-0 overflow-auto">
            <div
                class="card-header p-5 pb-0 bg-transparent border-0 d-flex align-items-center justify-content-between gap-3 flex-wrap">
                <div
                    class="card-header p-5 pb-0 bg-transparent border-0 d-flex align-items-center justify-content-between gap-3 flex-wrap">
                    <h4 class="mb-0 text-uppercase">Liste des Produits</h4>
                    <div class="d-flex align-items-center gap-6">
                        <form class="search-form card-search w-auto flex-shrink-0" action="">
                            <input type="text" name="search" class=" bg-white form-control" placeholder="Search">
                            <button type="submit" class="btn"><img src="assets/img/svg/search.svg" alt=""></button>
                        </form>
                        <a class="btn btn-sm btn-primary" href="#" data-bs-toggle="modal"
                           data-bs-target="#product_modal">
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

                        <a class="btn btn-sm btn-info pl-2" href="{{ route('app.supply.index') }}">
                            <!-- Download SVG icon from http://tabler-icons.io/i/settings -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24"
                                 height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M12 5l0 14"></path>
                                <path d="M5 12l14 0"></path>
                            </svg>
                            Approvisionner
                        </a>
                    </div>
                </div>


                <div class="card-body">
                    <div class="table-responsive">
                        <table class="defaultTable text-center w-100">
                            <thead>
                            <tr>
                                <th>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="checkbox1" value="">
                                    </div>
                                </th>
                                <th>N° Produit</th>
                                <th>Libellé</th>
                                <th>Prix V/U</th>
                                <th>CMD relatives</th>
                                <th>Appro relatifs</th>
                                <th>Opérations</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $i=1 @endphp
                            @forelse($products as $product)
                                <tr>
                                    <td><input type="checkbox" class="form-check-input" id="checkbox1" value=""></td>
                                    <td>N° {{ $i++ }}</td>
                                    <td class="text-muted">
                                        {{ $product->product_name }}
                                    </td>
                                    <td class="text-muted">
                                        {{ $product->unit_price }}
                                    </td>
                                    <td class="text-muted">
                                        {{ $product->order_items_count }} Commandes
                                    </td>
                                    <td class="text-muted">
                                        {{ $product->supplies_count }} Appros
                                    </td>
                                    <td>
                                        <div class="dropdown text-end">
                                            <a href="#" data-bs-toggle="dropdown" class="fs-24 text-gray"
                                               aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </a>
                                            <div class="dropdown-menu p-0" style="">
                                                <a class="dropdown-item"
                                                   href="{{ route('app.supply.product',$product->id) }}">Appros</a>
                                                <a class="dropdown-item"
                                                   wire:click.prevent='editProduct({{ $product->id }})'
                                                   href="#">Edit</a>
                                                <a class="dropdown-item"
                                                   wire:click.prevent="deleteProduct({{ $product->id }})" href="#">Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6"><span class="text-danger">Aucun Produit disponible</span></td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>

                        @if($products->count())
                            <div
                                class="mt-5 d-flex justify-content-center justify-content-md-between align-items-center flex-wrap">
                                {{ $products->links('livewire::bootstrap') }}
                            </div>
                        @endif
                    </div>
                </div>


            </div>


        </div>

    </div>


    <!-- model de creation et mise à jour des categories !-->
    <div wire:ignore.self class="modal modal-blur fade" id="product_modal" tabindex="-1" aria-hidden="true"
         style="display: none;"
         data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form class="modal-content" method="POST"
                  @if($updateProductMode) wire:submit.prevent='updateProduct()'
                  @else wire:submit.prevent='addProduct()' @endif >

                <div class="modal-header">
                    <h5 class="modal-title">{{ $updateProductMode? "Mise à jour du produit ".$product_name."":'Création d\'un nouveau produit' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf

                    @if($updateProductMode===true)

                        <input type="hidden" wire:model='selected_id'>
                    @endif

                    <div class="form-group mb-3">
                        <label class="form-label" for="product_name">Nom du produit</label>
                        <input type="text" class="form-control" id="product_name" name="product_name"
                               wire:model='product_name' placeholder="Saisissez un nouveau produit">
                        <span class="text-danger">@error('product_name'){{ $message }}@enderror</span>
                    </div>
                    <div class="row">
                        <div class="col-5">
                            <div class="form-group mb-3">
                                <label class="form-label" for="unit_price">Prix de vente unitaire</label>
                                <input type="number" class="form-control" id="unit_price"
                                       name="unit_price"
                                       wire:model='unit_price'
                                       placeholder="Saisissez le prix de vente unitaire">
                                <span class="text-danger">@error('unit_price'){{ $message }}@enderror</span>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="form-group mb-3">
                                <label for="unit_id" class="form-label">Unité de mésure</label>
                                <select name="unit_id" id="unit_id" class="form-control" wire:model="unit_id">
                                    <option value="">Sélectionner l'unité</option>
                                    @foreach(App\Models\Unit::orderBy('unit_name','asc')->select([
                                        'id','unit_name'])->get() as $unit)
                                        <option value="{{ $unit->id }}">{{ $unit->unit_name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">@error('unit_id'){{ $message }}@enderror</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label" for="product_description">Description du produit</label>
                        <textarea class="form-control" id="product_description" name="product_description"
                                  wire:model='product_description'>
                                pas obligatoire
                            </textarea>
                        <span class="text-danger">@error('product_name'){{ $message }}@enderror</span>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit"
                            class="btn btn-primary">{{ $updateProductMode? 'Mettre à jour':'Enregistrer' }}</button>
                </div>
            </form>
        </div>
    </div>

</div>
