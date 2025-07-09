<!DOCTYPE html>
<html>
<head>
    <title>Invoice Report PDF</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #333; padding: 4px; font-size: 12px; }
        th { background: #eee; }
    </style>
</head>
<body>
    <h2>Invoice Report</h2>
    <p>From: {{ $start }} To: {{ $end }}</p>
    <table>
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
                    <td colspan="7" style="text-align:center;">No invoices found for this period.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html> 