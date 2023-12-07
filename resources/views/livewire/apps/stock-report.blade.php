<div>
    {{-- Success is as dangerous as failure. --}}
    <div>
        <form wire:submit.prevent="render" class="mb-3">
            <div class="input-group">
                <select wire:model="selectedStatus" class="form-select">
                    <option value="">Choisir un statut</option>
                    @foreach($statuses as $status => $value)
                        <option value="{{ $value }}">Stock  {{ $status }}</option>
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
                    <td>
                        @empty($product->latestSupply)
                            N/A
                        @else
                            {{ $product->latestSupply->quantity_in_stock }} - {{ $product->unit->unit_sigle }}
                        @endempty
                    </td>
                    <td>{{ $product->unit->minimum_stock_level }}</td>
                    <td>
                        @if($product->stock_status === 'critical')
                            <i class="bi bi-exclamation-triangle-fill text-danger " style="width: 64px"></i>
                        @else
                            <i class="bi bi-check-circle-fill text-success " style="width: 64px"></i>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{-- Ajoutez la pagination ici --}}
        <div class="d-flex">
            {{ $products->links() }}
        </div>
    </div>

</div>
