@extends('layouts.tabler')

@section('content')
<div class="container-xl mt-4">
    <h2>Products</h2>
    <ul class="list-group">
        @forelse($products as $product)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span>{{ $product->name }}</span>
                <span class="badge bg-primary rounded-pill">{{ $product->price }}</span>
            </li>
        @empty
            <li class="list-group-item">No products found.</li>
        @endforelse
    </ul>
</div>
@endsection 