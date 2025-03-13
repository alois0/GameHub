@extends('layouts.admin')

@section('title', 'Commandes')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Commandes</h1>

    <!-- Display Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Display Validation Errors -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @component('components.admin-table', [
        'id' => 'ordersTable',
        'headers' => ['ID', 'Client', 'Total', 'Statut', 'Date', 'Opérations']
    ])
        @slot('slot')
            @foreach($orders as $order)
            <tr>
                <td class="py-2 px-4 border-b text-center">{{ $order->id }}</td>
                <td class="py-2 px-4 border-b text-center">{{ optional($order->user)->name ?? 'N/A' }}</td>
                <td class="py-2 px-4 border-b text-center">{{ number_format($order->total_price, 2) }} €</td>
                <td class="py-2 px-4 border-b text-center">{{ $order->status }}</td>
                <td class="py-2 px-4 border-b text-center">{{ $order->created_at->format('d/m/Y') }}</td>
                <td class="py-2 px-4 border-b text-center">
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#viewOrderModal{{ $order->id }}">Détails</button>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editOrderModal{{ $order->id }}">Modifier</button>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteOrderModal{{ $order->id }}">Supprimer</button>
                </td>
            </tr>
            @endforeach
        @endslot
    @endcomponent

    <!-- Modals -->
    @foreach($orders as $order)
    <!-- View Order Modal -->
    <div class="modal fade" id="viewOrderModal{{ $order->id }}" tabindex="-1" aria-labelledby="viewOrderModalLabel{{ $order->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewOrderModalLabel{{ $order->id }}">Détails de la commande</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    <h5>Commande ID: {{ $order->id }}</h5>
                    <p>Client: {{ optional($order->user)->name ?? 'N/A' }}</p>
                    <p>Total: {{ number_format($order->total_price, 2) }} €</p>
                    <p>Statut: {{ $order->status }}</p>
                    <p>Date: {{ $order->created_at->format('d/m/Y') }}</p>
                    
                    <h5>Articles</h5>
                    @if($order->orderDetails->isNotEmpty())
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Quantité</th>
                                    <th>Prix Unitaire</th>
                                    <th>Plateforme</th>
                                    <th>Adresse</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->orderDetails as $detail)
                                <tr>
                                    <td>{{ optional($detail->product)->product_name ?? 'N/A' }}</td>
                                    <td>{{ $detail->quantity }}</td>
                                    <td>{{ number_format($detail->price_each, 2) }} €</td>
                                    <td>{{ optional($detail->platform)->name ?? 'N/A' }}</td>
                                    <td>
                                        @if(optional($detail->address))
                                            {{ optional($detail->address)->street_number ?? '' }}
                                            {{ optional($detail->address)->street_name ?? '' }},
                                            {{ optional($detail->address)->city ?? '' }},
                                            {{ optional($detail->address)->postal_code ?? '' }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>Aucun article dans cette commande.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Order Modal -->
    <div class="modal fade" id="editOrderModal{{ $order->id }}" tabindex="-1" aria-labelledby="editOrderModalLabel{{ $order->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editOrderModalLabel{{ $order->id }}">Modifier</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    <form id="editOrderForm{{ $order->id }}" method="POST" action="{{ route('admin.orders.update', $order->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="editOrderStatus{{ $order->id }}" class="form-label">Statut</label>
                            <select class="form-control" id="editOrderStatus{{ $order->id }}" name="status" required>
                                <option value="Pending" {{ $order->status == 'Pending' ? 'selected' : '' }}>En attente</option>
                                <option value="Processing" {{ $order->status == 'Processing' ? 'selected' : '' }}>En cours de traitement</option>
                                <option value="Shipped" {{ $order->status == 'Shipped' ? 'selected' : '' }}>Expédié</option>
                                <option value="Delivered" {{ $order->status == 'Delivered' ? 'selected' : '' }}>Livré</option>
                                <option value="Canceled" {{ $order->status == 'Canceled' ? 'selected' : '' }}>Annulé</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Sauvegarder</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Order Modal -->
    <div class="modal fade" id="deleteOrderModal{{ $order->id }}" tabindex="-1" aria-labelledby="deleteOrderModalLabel{{ $order->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteOrderModalLabel{{ $order->id }}">Supprimer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    <p>Voulez-vous vraiment supprimer cette commande ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
                    <form method="POST" action="{{ route('admin.orders.destroy', $order->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <script>
        $(document).ready(function() {
            $('#ordersTable').DataTable({
                "pageLength": 25
            });
        });
    </script>
@endsection
