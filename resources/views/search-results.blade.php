@if($products->count())
    <h6>Products</h6>
    <ul class="list-group mb-2">
        @foreach($products as $product)
            <li class="list-group-item">{{ $product->name }} (SKU: {{ $product->id }})</li>
        @endforeach
    </ul>
@endif

@if($orders->count())
    <h6>Orders</h6>
    <ul class="list-group mb-2">
        @foreach($orders as $order)
            <li class="list-group-item">Order #{{ $order->invoice_no }} (ID: {{ $order->id }})</li>
        @endforeach
    </ul>
@endif

@if($customers->count())
    <h6>Customers</h6>
    <ul class="list-group mb-2">
        @foreach($customers as $customer)
            <li class="list-group-item">{{ $customer->name }} ({{ $customer->email }})</li>
        @endforeach
    </ul>
@endif

@if(!$products->count() && !$orders->count() && !$customers->count())
    <div class="text-muted">No results found.</div>
@endif
