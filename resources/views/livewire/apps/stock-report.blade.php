<div>
    {{-- Success is as dangerous as failure. --}}
    <div>
        <div class="d-flex justify-content-between align-items-center align-content-lg-stretch">
            <div class="col-8">
                <form wire:submit.prevent="render" class="mb-3">
                    <div class="input-group">
                        <select wire:model="selectedStatus" class="form-select">
                            <option value="">Choisir un statut</option>
                            @foreach($statuses as $status => $value)
                                <option value="{{ $value }}">Stock {{ $status }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
            <div class="col-4">
                {{-- Bouton d'exportation en PDF --}}
                <button wire:click="exportToPdf" class="btn btn-sm btn-success">Exporter en PDF</button>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered mt-2">
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
                        @php
                            $supply = \App\Models\Supply::where('product_id', $product->id)->latest()->first();
                            $supplyQ = $supply ? $supply->quantity_in_stock : null;
                        @endphp
                        <td>{{ $supplyQ ?? 'N/A' }} | {{ $product->unit->unit_sigle }}</td>
                        <td>{{ $product->unit->minimum_stock_level }}</td>
                        <td>
                            @if($product->stock_status === 'critical')
                                <i class="bi bi-exclamation-triangle-fill text-danger" style="width: 64px"></i>
                            @else
                                <i class="bi bi-check-circle-fill text-success" style="width: 64px"></i>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="4">
                        <div class="d-flex justify-content-center">
                            @if(!$selectedStatus)
                                <h4 class="text-info text-uppercase"> Total Produits:  {{ $totalProducts }} </h4>
                            @else
                                <h4 class="{{ $selectedStatus==='critical' ? 'text-danger': 'text-success' }} text-uppercase">
                                    Total :  {{ $totalProducts }} {{ $selectedStatus==='critical' ? 'Produits à stock critique': 'Produits à stock normal' }}
                                </h4>
                            @endif
                            </div>
                    </td>
                    </tr>
                    @if($totalProducts>25)
                        <tr>
                            <td colspan="4">
                                <div class="d-flex justify-content-center">
                                    {{ $products->links() }}
                                </div>
                            </td>
                        </tr>
                    @endif

                </tfoot>
            </table>
        </div>

    </div>

</div>
