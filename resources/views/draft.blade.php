<div class="row row-cols-1 row-cols-md-2 g-4">
    <div class="col">
        <div class="card text-white bg-primary overflow-hidden w-50 m-2 p-2">
            <div class="card-body">
                <h3 class="card-title">Recette totale</h3>
                <p class="card-text fs-4">{{ number_format($totalRevenue, 0, ',', ' ') }} FC</p>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="card text-white bg-primary overflow-hidden w-50 m-2 p-2">
            <div class="card-body">
                <h3 class="card-title">Nombre total de commandes</h3>
                <p class="card-text fs-4">{{ round($totalOrders) }} {{ $totalOrders<=1?'commande':'commandes' }}</p>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card text-white bg-primary overflow-hidden w-50 m-2 p-2">
            <div class="card-body">
                <h3 class="card-title">Marge brute en valeur</h3>
                <p class="card-text fs-4">{{ number_format($grossMarginValue, 0, ',', ' ') }} FC</p>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card text-white bg-primary overflow-hidden w-50 m-2 p-2">
            <div class="card-body">
                <h3 class="card-title">Marge brute en pourcentage</h3>
                <p class="card-text fs-4">{{ round($grossMarginPercentage) }}%</p>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card text-white bg-primary overflow-hidden w-50 m-2 p-2">
            <div class="card-body">
                <h3 class="card-title">Coût de marchandises vendues</h3>
                <p class="card-text fs-4">{{ number_format($cmv, 0, ',', ' ') }} FC</p>
            </div>
        </div>
    </div>
</div>

