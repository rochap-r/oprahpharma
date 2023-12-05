<div>
    {{-- Success is as dangerous as failure. --}}
    <div>
        <form wire:submit.prevent="render" class="mb-3">
            <div class="input-group">
                <select wire:model="selectedUnit" class="form-select">
                    <option value="">Choisir une unité</option>
                    @foreach($units as $unit)
                        <option value="{{ $unit->id }}">{{ $unit->unit_name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary">Filtrer</button>
            </div>
        </form>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Produit</th>
                <th>Qté stock</th>
                <th>Limite stock</th>
                <th>Statut</th>
            </tr>
            </thead>
            <tbody class="text-center">
            @foreach($products as $product)
                <tr class="{{ $product->stock_status === 'critical' ? 'table-danger' : 'table-success' }} fw-bold">
                    <td>{{ $product->product_name }}</td>
                    <td>{{ \App\Models\Supply::where('product_id',$product->id)->latest()->first() ?
                            \App\Models\Supply::where('product_id',$product->id)->latest()->first()->quantity_in_stock : 'N/A' }}
                        - {{ $product->unit->unit_sigle }}</td>
                    <td>{{ $product->unit->minimum_stock_level }}</td>
                    <td>
                        @if($product->stock_status === 'critical')
                            <i class="bi bi-exclamation-triangle-fill text-danger " style="width: 64px"></i>
                            <!-- Icone pour 'Critique' -->
                        @else
                            <i class="bi bi-check-circle-fill text-success " style="width: 64px"></i>
                            <!-- Icone pour 'Abordable' -->
                        @endif
                    </td>
                </tr>

            @endforeach
            </tbody>
        </table>
    </div>

</div>
