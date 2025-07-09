@extends('layouts.tabler')

@section('content')
<div class="container-xl py-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">
            <i class="ti ti-receipt me-2"></i>Expenses
        </h3>
        <a href="{{ route('expenses.create') }}" class="btn btn-primary">
            <i class="ti ti-plus me-2"></i>Add Expense
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-vcenter card-table">
                    <thead>
                        <tr>
                            <th>Expense #</th>
                            <th>Title</th>
                            <th>Amount</th>
                            <th>Category</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($expenses as $expense)
                            <tr>
                                <td>{{ $expense->expense_number }}</td>
                                <td>{{ $expense->title }}</td>
                                <td>{{ number_format($expense->amount, 2) }}</td>
                                <td>{{ $expense->category }}</td>
                                <td>{{ $expense->expense_date->format('Y-m-d') }}</td>
                                <td>
                                    <span class="badge bg-{{ $expense->status === 'approved' ? 'success' : ($expense->status === 'rejected' ? 'danger' : 'warning') }}">
                                        {{ ucfirst($expense->status) }}
                                    </span>
                                </td>
                                <td class="text-nowrap">
                                    <a href="{{ route('expenses.show', $expense) }}" class="btn btn-sm btn-link" title="View">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <a href="{{ route('expenses.edit', $expense) }}" class="btn btn-sm btn-link" title="Edit">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    @if($expense->attachment)
                                        <a href="{{ Storage::url($expense->attachment) }}" class="btn btn-sm btn-link" title="Download Attachment" download>
                                            <i class="fa-solid fa-download"></i>
                                        </a>
                                    @endif
                                    <form action="{{ route('expenses.destroy', $expense) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this expense?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-link text-danger" title="Delete">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No expenses found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $expenses->links() }}
            </div>
        </div>
    </div>
</div>
@endsection 