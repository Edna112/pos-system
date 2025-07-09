@extends('layouts.tabler')

@section('content')
<div class="container-xl py-3">
    <h2>Invoice Report</h2>
    <form method="GET" class="mb-4">
        <div class="row g-2">
            <div class="col-auto">
                <input type="date" name="start_date" class="form-control" value="{{ $start }}">
            </div>
            <div class="col-auto">
                <input type="date" name="end_date" class="form-control" value="{{ $end }}">
            </div>
            <div class="col-auto">
                <select name="period" class="form-control">
                    <option value="daily" {{ $period == 'daily' ? 'selected' : '' }}>Daily</option>
                    <option value="monthly" {{ $period == 'monthly' ? 'selected' : '' }}>Monthly</option>
                    <option value="yearly" {{ $period == 'yearly' ? 'selected' : '' }}>Yearly</option>
                </select>
            </div>
            <div class="col-auto">
                <button class="btn btn-primary" type="submit">Filter</button>
            </div>
        </div>
    </form>
    <a href="{{ route('invoices.report.export.pdf', ['start_date' => $start, 'end_date' => $end, 'period' => $period]) }}" class="btn btn-danger mb-3" target="_blank">
        Export PDF
    </a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Invoice #</th>
                <th>Customer</th>
                <th>Total Products</th>
                <th>Subtotal</th>
                <th>VAT</th>
                <th>Total</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
                <tr>
                    <td>{{ $order->invoice_no }}</td>
                    <td>{{ $order->customer->name ?? 'N/A' }}</td>
                    <td>{{ $order->total_products }}</td>
                    <td>{{ $order->sub_total }}</td>
                    <td>{{ $order->vat }}</td>
                    <td>{{ $order->total }}</td>
                    <td>{{ $order->created_at->format('Y-m-d') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No invoices found for this period.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection 