<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}

    <div class="container py-5">
        <form>
            <div class="row mb-4">
                <div class="col">
                    <label for="startDate" class="form-label">Date de début</label>
                    <input type="datetime-local" id="startDate" wire:model="startDate" class="form-control">
                </div>
                <div class="col">
                    <label for="endDate" class="form-label">Date de fin</label>
                    <input type="datetime-local" id="endDate" wire:model="endDate" class="form-control">
                </div>
                <div class="col">
                    <label for="userId" class="form-label">Utilisateur</label>
                    <select id="userId" wire:model="userId" class="form-select">
                        <option value="">Tous les utilisateurs</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>

        <div class="row  row-cols-sm-2  d-flex flex-wrap justify-content-around">
            <div class="col-sm-6">
                <div class="card text-white bg-primary overflow-hidden h-75">
                    <div class="card-body">
                        <h5 class="card-title text-uppercase">Recette totale</h5>
                        <p class="card-text fs-2 fw-bold">{{ number_format($totalRevenue, 0, ',', ' ') }} FC</p>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="card text-white bg-primary overflow-hidden h-75">
                    <div class="card-body">
                        <h5 class="card-title text-uppercase">Ventes</h5>
                        <p class="card-text fs-2 fw-bold">{{ round($totalOrders) }} {{ $totalOrders<=1?'Vente':'Ventes' }}</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card text-white bg-success overflow-hidden  h-75">
                    <div class="card-body">
                        <h5 class="card-title text-uppercase">Marge brute</h5>
                        <p class="card-text fs-2 fw-bold">{{ number_format($grossMarginValue, 0, ',', ' ') }} FC</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card text-white bg-success overflow-hidden   h-75">
                    <div class="card-body">
                        <h5 class="card-title text-uppercase">Marge brute %</h5>
                        <p class="card-text fs-2 fw-bold">{{ number_format($grossMarginPercentage, 2, ',', '') }}%</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card text-white bg-success overflow-hidden h-75">
                    <div class="card-body">
                        <h5 class="card-title text-uppercase">CMV</h5>
                        <p class="card-text fs-2 fw-bold">{{ number_format($cmv, 0, ',', ' ') }} FC</p>
                    </div>
                </div>
            </div>
        </div>



    </div>


</div>
