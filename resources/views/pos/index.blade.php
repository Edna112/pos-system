@extends('layouts.tabler')

@section('content')
<div class="container-xl mt-4">
    <h2>Point of Sale</h2>
    <form method="GET" action="{{ route('pos.products') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search products..." />
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>

    <hr>
    <h3>Recent Orders</h3>
    <livewire:tables.order-table />
</div>
@endsection 