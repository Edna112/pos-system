<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use Barryvdh\DomPDF\Facade\Pdf;

class SalesController extends Controller
{
    public function report(Request $request)
    {
        $period = $request->input('period', 'monthly');
        $customStart = $request->input('start_date');
        $customEnd = $request->input('end_date');

        switch ($period) {
            case 'daily':
                $start = $customStart ?? now()->toDateString();
                $end = $customEnd ?? now()->toDateString();
                break;
            case 'monthly':
                $start = $customStart ?? now()->startOfMonth()->toDateString();
                $end = $customEnd ?? now()->endOfMonth()->toDateString();
                break;
            case 'yearly':
                $start = $customStart ?? now()->startOfYear()->toDateString();
                $end = $customEnd ?? now()->endOfYear()->toDateString();
                break;
            default:
                $start = $customStart ?? now()->subMonth()->toDateString();
                $end = $customEnd ?? now()->toDateString();
        }

        $sales = Sale::whereBetween('created_at', [$start, $end])->with('user')->get();

        return view('sales.report', [
            'sales' => $sales,
            'start' => $start,
            'end' => $end,
            'period' => $period,
        ]);
    }

    public function exportPdf(Request $request)
    {
        $period = $request->input('period', 'monthly');
        $start = $request->input('start_date');
        $end = $request->input('end_date');

        // Use your existing date logic here if needed

        $sales = \App\Models\Sale::whereBetween('created_at', [$start, $end])->with('user')->get();

        $pdf = Pdf::loadView('sales.report-pdf', [
            'sales' => $sales,
            'start' => $start,
            'end' => $end,
            'period' => $period,
        ]);

        $filename = 'sales-report-' . $period . '-' . $start . '-to-' . $end . '.pdf';
        return $pdf->download($filename);
    }
}
