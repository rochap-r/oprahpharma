<div>
    {{-- Stop trying to control. --}}

    <div class="row ">
        <div class="card mb-2">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs my-1">
                    <h4>Toutes les Fonctionnalités du système</h4>
                </ul>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-light">
                        <tr>
                            <th>N° Fonction</th>
                            <th>Code url</th>
                            <th>Description</th>
                            <th class="w-1">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($permissions as $permission)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="ms-2">
                                            <h6 class="mb-0 font-14">N° {{ $permission->id }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $permission->name }}</td>

                                <td>{{ $permission->description }}</td>

                                <td>
                                    <div class="d-flex order-actions">
                                        <a href="#" class="btn btn-primary" wire:click.prevent='editPermission({{ $permission->id }})'>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil" width="18" height="24" viewBox="0 0 18 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4"></path>
                                                <path d="M13.5 6.5l4 4"></path>
                                            </svg>
                                            éditer
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4"><span class="text-danger">Aucune Fonction disponible</span></td>
                            </tr>
                        @endforelse
                        <tr>
                            <td colspan="4">
                                <div class="d-block mt-2">
                                    {{ $permissions->links('livewire::bootstrap') }}
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- model de creation et mise à jour des roles !-->
    <div wire:ignore.self class="modal modal-blur fade" id="permissions_update_modal" tabindex="-1" aria-hidden="true" style="display: none;"
         data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <form class="modal-content" method="POST"dd wire:submit.prevent='updateRole()'>

                <div class="modal-header">
                    <h5 class="modal-title">Mise à jour du Role : {{ $name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    <input type="hidden" wire:model='selected_id'>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="border border-1  p-4">
                                <div class="mb-3">
                                    <label for="inputProductTitle" class="form-label">Code url</label>
                                    <input type="text" name="name" required class="form-control" id="inputProductTitle" placeholder="Tapez le titre du role" wire:model="name" readonly>
                                    <span class="text-danger"> @error('name'){{ $message }}@enderror </span>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Nom de la Fonction</label>
                                    <input type="text" name="description" required class="form-control" id="description" placeholder="Tapez le nom de la fonction" wire:model="description">
                                    <span class="text-danger"> @error('description'){{ $message }}@enderror </span>
                                </div>
                            </div>
                        </div>
                    </div><!--end row-->

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>


</div>
