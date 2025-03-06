@extends('layouts.admin')

@section('title', 'Orders')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Orders</h1>

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

    <div class="overflow-x-auto mb-8" style="max-height: 80vh;">
        <table id="ordersTable" class="min-w-full bg-white table-fixed">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b w-1/12 text-center">ID</th>
                    <th class="py-2 px-4 border-b w-2/12 text-center">Customer</th>
                    <th class="py-2 px-4 border-b w-2/12 text-center">Total</th>
                    <th class="py-2 px-4 border-b w-2/12 text-center">Status</th>
                    <th class="py-2 px-4 border-b w-2/12 text-center">Date</th>
                    <th class="py-2 px-4 border-b w-3/12 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td class="py-2 px-4 border-b text-center">{{ $order->id }}</td>
                    <td class="py-2 px-4 border-b text-center">{{ $order->user->name }}</td>
                    <td class="py-2 px-4 border-b text-center">{{ number_format($order->total, 2) }} €</td>
                    <td class="py-2 px-4 border-b text-center">{{ $order->status }}</td>
                    <td class="py-2 px-4 border-b text-center">{{ $order->created_at->format('d/m/Y') }}</td>
                    <td class="py-2 px-4 border-b text-center">
                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#viewOrderModal{{ $order->id }}">View</button>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editOrderModal{{ $order->id }}">Edit</button>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteOrderModal{{ $order->id }}">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modals -->
    @foreach($orders as $order)
    <!-- View Order Modal -->
    <div class="modal fade" id="viewOrderModal{{ $order->id }}" tabindex="-1" aria-labelledby="viewOrderModalLabel{{ $order->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewOrderModalLabel{{ $order->id }}">Order Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5>Order ID: {{ $order->id }}</h5>
                    <p>Customer: {{ $order->user->name }}</p>
                    <p>Total: {{ number_format($order->total, 2) }} €</p>
                    <p>Status: {{ $order->status }}</p>
                    <p>Date: {{ $order->created_at->format('d/m/Y') }}</p>
                    <h5>Order Items:</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Platform</th>
                                <th>Address</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->orderDetails as $detail)
                            <tr>
                                <td>{{ $detail->product->product_name }}</td>
                                <td>{{ $detail->quantity }}</td>
                                <td>{{ number_format($detail->price, 2) }} €</td>
                                <td>{{ $detail->platform->name }}</td>
                                <td>{{ $detail->address->full_address }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Order Modal -->
    <div class="modal fade" id="editOrderModal{{ $order->id }}" tabindex="-1" aria-labelledby="editOrderModalLabel{{ $order->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editOrderModalLabel{{ $order->id }}">Edit Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editOrderForm{{ $order->id }}" method="POST" action="{{ route('admin.orders.update', $order->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="editOrderStatus{{ $order->id }}" class="form-label">Status</label>
                            <select class="form-control" id="editOrderStatus{{ $order->id }}" name="status" required>
                                <option value="Pending" {{ $order->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Processing" {{ $order->status == 'Processing' ? 'selected' : '' }}>Processing</option>
                                <option value="Shipped" {{ $order->status == 'Shipped' ? 'selected' : '' }}>Shipped</option>
                                <option value="Delivered" {{ $order->status == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                                <option value="Canceled" {{ $order->status == 'Canceled' ? 'selected' : '' }}>Canceled</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
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
                    <h5 class="modal-title" id="deleteOrderModalLabel{{ $order->id }}">Delete Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this order?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <form method="POST" action="{{ route('admin.orders.destroy', $order->id) }}" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete Order</button>
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