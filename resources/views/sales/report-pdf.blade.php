<!DOCTYPE html>
<html>
<head>
    <title>Sales Report PDF</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #333; padding: 4px; font-size: 12px; }
        th { background: #eee; }
    </style>
</head>
<body>
    <h2>Sales Report</h2>
    <p>From: {{ $start }} To: {{ $end }}</p>
    <table>
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
                    <td colspan="7" style="text-align:center;">No sales found for this period.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
