@extends('layouts.tabler')

@section('content')
<div class="container-xl py-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">
            <i class="ti ti-receipt me-2"></i>Expense Details
        </h3>
        <div>
            <a href="{{ route('expenses.edit', $expense) }}" class="btn btn-primary me-2">
                <i class="ti ti-pencil me-1"></i> Edit
            </a>
            <a href="{{ route('expenses.index') }}" class="btn btn-link">
                <i class="ti ti-arrow-left"></i> Back to Expenses
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label text-muted">Expense Number</label>
                        <div class="fw-bold">{{ $expense->expense_number }}</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Title</label>
                        <div class="fw-bold">{{ $expense->title }}</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Amount</label>
                        <div class="fw-bold">{{ number_format($expense->amount, 2) }}</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Category</label>
                        <div class="fw-bold">{{ $expense->category ?? 'N/A' }}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label text-muted">Payment Method</label>
                        <div class="fw-bold">{{ $expense->payment_method ?? 'N/A' }}</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Expense Date</label>
                        <div class="fw-bold">{{ $expense->expense_date->format('Y-m-d') }}</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Reference Number</label>
                        <div class="fw-bold">{{ $expense->reference_number ?? 'N/A' }}</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Status</label>
                        <div>
                            <span class="badge bg-{{ $expense->status === 'approved' ? 'success' : ($expense->status === 'rejected' ? 'danger' : 'warning') }}">
                                {{ ucfirst($expense->status) }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-3">
                        <label class="form-label text-muted">Description</label>
                        <div class="fw-bold">{{ $expense->description ?? 'N/A' }}</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-3">
                        <label class="form-label text-muted">Notes</label>
                        <div class="fw-bold">{{ $expense->notes ?? 'N/A' }}</div>
                    </div>
                </div>
                @if($expense->attachment)
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="form-label text-muted">Attachment</label>
                            <div>
                                <a href="{{ Storage::url($expense->attachment) }}" target="_blank" class="btn btn-sm btn-secondary">
                                    <i class="ti ti-paperclip me-1"></i> View Attachment
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="col-12">
                    <div class="mb-3">
                        <label class="form-label text-muted">Created By</label>
                        <div class="fw-bold">{{ $expense->user->name ?? 'N/A' }}</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-3">
                        <label class="form-label text-muted">Created At</label>
                        <div class="fw-bold">{{ $expense->created_at->format('Y-m-d H:i:s') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 