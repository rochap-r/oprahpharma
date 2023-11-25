<div>
    {{-- The whole world belongs to you. --}}

    <div class="row ">
        <div class="card border-0 overflow-auto">
            <div
                class="card-header p-5 pb-0 bg-transparent border-0 d-flex align-items-center justify-content-between gap-3 flex-wrap">
                <div
                    class="card-header p-5 pb-0 bg-transparent border-0 d-flex align-items-center justify-content-between gap-3 flex-wrap">
                    <h4 class="mb-0 text-uppercase">Liste d'unités de mésure'</h4>
                    <div class="d-flex align-items-center gap-6">
                        <form class="search-form card-search w-auto flex-shrink-0" action="">
                            <input type="text" name="search" class=" bg-white form-control" placeholder="Search">
                            <button type="submit" class="btn"><img src="assets/img/svg/search.svg" alt=""></button>
                        </form>
                        <a class="btn btn-sm btn-primary" href="#" data-bs-toggle="modal"
                           data-bs-target="#unit_modal">
                            <!-- Download SVG icon from http://tabler-icons.io/i/settings -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24"
                                 height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M12 5l0 14"></path>
                                <path d="M5 12l14 0"></path>
                            </svg>
                            Nouvelle Unité de mésure
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
                                <th>N°</th>
                                <th>Unité</th>
                                <th>Sigle</th>
                                <th>Produits relatifs</th>
                                <th>Opérations</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $i=1 @endphp
                            @forelse($units as $unit)
                                <tr>
                                    <td><input type="checkbox" class="form-check-input" id="checkbox1" value=""></td>
                                    <td>N° {{ $i++ }}</td>
                                    <td class="text-muted">
                                        {{ $unit->unit_name }}
                                    </td>
                                    <td class="text-muted">
                                        {{ $unit->unit_sigle }}
                                    </td>
                                    <td class="text-muted">
                                        {{ $unit->products_count }} produits
                                    </td>
                                    <td>
                                        <div class="dropdown text-end">
                                            <a href="#" data-bs-toggle="dropdown" class="fs-24 text-gray"
                                               aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </a>
                                            <div class="dropdown-menu p-0" style="">
                                                <a class="dropdown-item"
                                                   wire:click.prevent='editUnit({{ $unit->id }})'
                                                   href="#">Edit</a>
                                                <a class="dropdown-item"
                                                   wire:click.prevent="deleteUnit({{ $unit->id }})" href="#">Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6"><span class="text-danger">Aucune Unité de mésure disponible</span></td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>

                        @if($units->count())
                            <div
                                class="mt-5 d-flex justify-content-center justify-content-md-between align-items-center flex-wrap">
                                {{ $units->links('livewire::bootstrap') }}
                            </div>
                        @endif
                    </div>
                </div>


            </div>


        </div>

    </div>


    <!-- model de creation et mise à jour des categories !-->
    <div wire:ignore.self class="modal modal-blur fade" id="unit_modal" tabindex="-1" aria-hidden="true"
         style="display: none;"
         data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form class="modal-content" method="POST"
                  @if($updateUnitMode) wire:submit.prevent='updateUnit()'
                  @else wire:submit.prevent='addUnit()' @endif >

                <div class="modal-header">
                    <h5 class="modal-title">{{ $updateUnitMode? "Mise à jour de l'unité de mésure ".$unit_name."":'Création d\'une nouvelle unité de mésure' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf

                    @if($updateUnitMode===true)

                        <input type="hidden" wire:model='selected_id'>
                    @endif

                    <div class="form-group mb-3">
                        <label class="form-label" for="unit_name">Nom complet de l'unité</label>
                        <input type="text" class="form-control" id="unit_name" name="unit_name"
                               wire:model='unit_name' placeholder="Saisissez une nouvelle unité de mesure">
                        <span class="text-danger">@error('unit_name'){{ $message }}@enderror</span>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label" for="unit_sigle">Unité de mésure</label>
                        <input type="text" class="form-control" id="unit_sigle" name="unit_sigle"
                               wire:model='unit_sigle' placeholder="Saisissez l'abréviation de la mesure">
                        <span class="text-danger">@error('unit_sigle'){{ $message }}@enderror</span>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit"
                            class="btn btn-primary">{{ $updateUnitMode? 'Mettre à jour':'Enregistrer' }}</button>
                </div>
            </form>
        </div>
    </div>

</div>
