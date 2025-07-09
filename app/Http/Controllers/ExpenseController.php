<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('expenses.index', compact('expenses'));
    }

    public function create()
    {
        return view('expenses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'amount' => 'required|numeric|min:0',
            'expense_date' => 'required|date',
            'category' => 'nullable|string|max:255',
            'payment_method' => 'nullable|string|max:255',
            'reference_number' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'attachment' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $expense = new Expense($validated);
        $expense->user_id = auth()->id();
        $expense->expense_number = $expense->generateExpenseNumber();

        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('expenses', 'public');
            $expense->attachment = $path;
        }

        $expense->save();

        return redirect()->route('expenses.index')
            ->with('success', 'Expense created successfully.');
    }

    public function show(Expense $expense)
    {
        return view('expenses.show', compact('expense'));
    }

    public function edit(Expense $expense)
    {
        return view('expenses.edit', compact('expense'));
    }

    public function update(Request $request, Expense $expense)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'amount' => 'required|numeric|min:0',
            'expense_date' => 'required|date',
            'category' => 'nullable|string|max:255',
            'payment_method' => 'nullable|string|max:255',
            'reference_number' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'attachment' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('attachment')) {
            if ($expense->attachment) {
                Storage::disk('public')->delete($expense->attachment);
            }
            $path = $request->file('attachment')->store('expenses', 'public');
            $validated['attachment'] = $path;
        }

        $expense->update($validated);

        return redirect()->route('expenses.index')
            ->with('success', 'Expense updated successfully.');
    }

    public function destroy(Expense $expense)
    {
        if ($expense->attachment) {
            Storage::disk('public')->delete($expense->attachment);
        }
        
        $expense->delete();

        return redirect()->route('expenses.index')
            ->with('success', 'Expense deleted successfully.');
    }

    // Report Methods
    public function dailyReport(Request $request)
    {
        $date = $request->input('date', now()->toDateString());
        $expenses = Expense::whereDate('expense_date', $date)
            ->with('user')
            ->get();

        $total = $expenses->sum('amount');

        return view('expenses.reports.daily', compact('expenses', 'total', 'date'));
    }

    public function monthlyReport(Request $request)
    {
        $month = $request->input('month', now()->format('Y-m'));
        $start = Carbon::parse($month)->startOfMonth();
        $end = Carbon::parse($month)->endOfMonth();

        $expenses = Expense::whereBetween('expense_date', [$start, $end])
            ->with('user')
            ->get();

        $total = $expenses->sum('amount');
        $byCategory = $expenses->groupBy('category')
            ->map(fn($items) => $items->sum('amount'));

        return view('expenses.reports.monthly', compact('expenses', 'total', 'month', 'byCategory'));
    }

    public function yearlyReport(Request $request)
    {
        $year = $request->input('year', now()->year);
        $start = Carbon::parse("$year-01-01")->startOfYear();
        $end = Carbon::parse("$year-12-31")->endOfYear();

        $expenses = Expense::whereBetween('expense_date', [$start, $end])
            ->with('user')
            ->get();

        $total = $expenses->sum('amount');
        $byMonth = $expenses->groupBy(fn($item) => $item->expense_date->format('Y-m'))
            ->map(fn($items) => $items->sum('amount'));

        return view('expenses.reports.yearly', compact('expenses', 'total', 'year', 'byMonth'));
    }

    public function customReport(Request $request)
    {
        $start = $request->input('start_date', now()->subMonth()->toDateString());
        $end = $request->input('end_date', now()->toDateString());

        $expenses = Expense::whereBetween('expense_date', [$start, $end])
            ->with('user')
            ->get();

        $total = $expenses->sum('amount');
        $byCategory = $expenses->groupBy('category')
            ->map(fn($items) => $items->sum('amount'));

        return view('expenses.reports.custom', compact('expenses', 'total', 'start', 'end', 'byCategory'));
    }

    // Export Methods
    public function exportPdf(Request $request)
    {
        $start = $request->input('start_date');
        $end = $request->input('end_date');

        $expenses = Expense::when($start && $end, function($query) use ($start, $end) {
                return $query->whereBetween('expense_date', [$start, $end]);
            })
            ->with('user')
            ->get();

        $total = $expenses->sum('amount');
        $pdf = Pdf::loadView('expenses.reports.pdf', compact('expenses', 'total', 'start', 'end'));

        return $pdf->download('expense-report.pdf');
    }

    public function exportExcel(Request $request)
    {
        $start = $request->input('start_date');
        $end = $request->input('end_date');

        $expenses = Expense::when($start && $end, function($query) use ($start, $end) {
                return $query->whereBetween('expense_date', [$start, $end]);
            })
            ->with('user')
            ->get();

        // TODO: Implement Excel export using Laravel Excel package
        return back()->with('error', 'Excel export not implemented yet.');
    }

    // Approval Methods
    public function approve(Expense $expense)
    {
        $expense->update(['status' => 'approved']);
        return back()->with('success', 'Expense approved successfully.');
    }

    public function reject(Expense $expense)
    {
        $expense->update(['status' => 'rejected']);
        return back()->with('success', 'Expense rejected successfully.');
    }

    // Category Methods
    public function categories()
    {
        $categories = Expense::select('category')
            ->whereNotNull('category')
            ->distinct()
            ->get()
            ->pluck('category');

        $categoriesWithTotals = Expense::whereNotNull('category')
            ->selectRaw('category, COUNT(*) as count, SUM(amount) as total')
            ->groupBy('category')
            ->get();

        return view('expenses.categories.index', compact('categories', 'categoriesWithTotals'));
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:expenses,category'
        ]);

        // Since we're using the category field in the expenses table,
        // we don't need a separate categories table
        return back()->with('success', 'Category added successfully.');
    }

    public function updateCategory(Request $request, $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:expenses,category'
        ]);

        Expense::where('category', $category)
            ->update(['category' => $request->name]);

        return back()->with('success', 'Category updated successfully.');
    }

    public function destroyCategory($category)
    {
        Expense::where('category', $category)
            ->update(['category' => null]);

        return back()->with('success', 'Category deleted successfully.');
    }
} 