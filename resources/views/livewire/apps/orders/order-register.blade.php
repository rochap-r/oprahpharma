<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <div>
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <form wire:submit.prevent="render" class="mb-3">
                    <div class="input-group">
                        <input type="number" wire:model="searchTotal" class="form-control"
                               placeholder="Rechercher par total">
                        <input type="datetime-local" wire:model="searchDateStart" class="form-control"
                               placeholder="Date de début">
                        <input type="datetime-local" wire:model="searchDateEnd" class="form-control"
                               placeholder="Date de fin">
                    </div>
                </form>
            </div>
            <div class="col-lg-2 col-md-12">
                <button wire:click="export" class="btn btn-sm btn-success">Excel</button>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-light">
            <tr>
                <th>Vendeur (euse)</th>
                <th>Date de la commande</th>
                <th>Prix total</th>
                <th>Nb Prods</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr data-bs-toggle="collapse" data-bs-target="#order{{$order->id}}"
                    aria-expanded="false" aria-controls="order{{$order->id}}">
                    <td>{{ $order->user->lname }} - {{ $order->user->name }}</td>
                    <td>{{ $order->order_date }}</td>
                    <td>{{ number_format(round($order->total_price), 0, ',', ' ') }} FC</td>
                    <td>{{ $order->orderItems->count() }}</td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div id="order{{$order->id}}" class="collapse"
                             aria-labelledby="headingOrder{{$order->id}}"
                             data-bs-parent="#order{{$order->id}}">
                            <table class="table table-sm table-bordered bg-light m-2 w-80">
                                <thead>
                                <tr>
                                    <th>Produit</th>
                                    <th>Qté</th>
                                    <th>Prix de vente</th>
                                    <th>Prix total</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($order->orderItems as $orderItem)
                                    <tr>
                                        <td>{{ $orderItem->product->product_name }}</td>
                                        <td>{{ $orderItem->quantity }}</td>
                                        <td>{{ number_format(round($orderItem->product->unit_price), 0, ',', ' ') }}
                                            FC
                                        </td>
                                        <td>{{ number_format(round($orderItem->line_price), 0, ',', ' ') }}
                                            FC
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            @if(count($orders)>25)
                <tr>
                    <td colspan="4">
                        <div class="d-flex justify-content-center">
                            {{ $orders->links('livewire::bootstrap') }}
                        </div>
                    </td>
                </tr>
            @endif
            </tfoot>
        </table>

    </div>
</div>

