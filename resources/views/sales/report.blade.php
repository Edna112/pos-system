@extends('layouts.tabler')

@section('content')
<div class="container-xl py-3">
    <h2>Sales Report</h2>
    <form method="GET" class="mb-4">
        <div class="row g-2">
            <div class="col-auto">
                <input type="date" name="start_date" class="form-control" value="{{ $start }}">
            </div>
            <div class="col-auto">
                <input type="date" name="end_date" class="form-control" value="{{ $end }}">
            </div>
            <div class="col-auto">
                <button class="btn btn-primary" type="submit">Filter</button>
            </div>
        </div>
    </form>
    <a href="{{ route('sales.report.export.pdf', ['start_date' => $start, 'end_date' => $end, 'period' => $period ?? 'monthly']) }}" class="btn btn-danger mb-3" target="_blank">
        Export PDF
    </a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Invoice #</th>
                <th>User</th>
                <th>Total Amount</th>
                <th>Discount</th>
                <th>Tax</th>
                <th>Grand Total</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($sales as $sale)
                <tr>
                    <td>{{ $sale->invoice_number }}</td>
                    <td>{{ $sale->user->name ?? 'N/A' }}</td>
                    <td>{{ $sale->total_amount }}</td>
                    <td>{{ $sale->discount_amount }}</td>
                    <td>{{ $sale->tax_amount }}</td>
                    <td>{{ $sale->grand_total }}</td>
                    <td>{{ $sale->created_at->format('Y-m-d') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No sales found for this period.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
