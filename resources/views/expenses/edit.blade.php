@extends('layouts.tabler')

@section('content')
<div class="container-xl py-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">
            <i class="ti ti-receipt me-2"></i>Edit Expense
        </h3>
        <a href="{{ route('expenses.index') }}" class="btn btn-link">
            <i class="ti ti-arrow-left"></i> Back to Expenses
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('expenses.update', $expense) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $expense->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Amount <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" name="amount" class="form-control @error('amount') is-invalid @enderror" value="{{ old('amount', $expense->amount) }}" required>
                        @error('amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Category</label>
                        <select name="category" class="form-select @error('category') is-invalid @enderror">
                            <option value="">Select Category</option>
                            @foreach(['Office Supplies', 'Utilities', 'Rent', 'Salaries', 'Marketing', 'Travel', 'Maintenance', 'Others'] as $category)
                                <option value="{{ $category }}" {{ old('category', $expense->category) === $category ? 'selected' : '' }}>
                                    {{ $category }}
                                </option>
                            @endforeach
                        </select>
                        @error('category')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Payment Method</label>
                        <select name="payment_method" class="form-select @error('payment_method') is-invalid @enderror">
                            <option value="">Select Payment Method</option>
                            @foreach(['Cash', 'Bank Transfer', 'Credit Card', 'Mobile Money', 'Check'] as $method)
                                <option value="{{ $method }}" {{ old('payment_method', $expense->payment_method) === $method ? 'selected' : '' }}>
                                    {{ $method }}
                                </option>
                            @endforeach
                        </select>
                        @error('payment_method')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Expense Date <span class="text-danger">*</span></label>
                        <input type="date" name="expense_date" class="form-control @error('expense_date') is-invalid @enderror" value="{{ old('expense_date', $expense->expense_date->format('Y-m-d')) }}" required>
                        @error('expense_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Reference Number</label>
                        <input type="text" name="reference_number" class="form-control @error('reference_number') is-invalid @enderror" value="{{ old('reference_number', $expense->reference_number) }}">
                        @error('reference_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3">{{ old('description', $expense->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label">Notes</label>
                        <textarea name="notes" class="form-control @error('notes') is-invalid @enderror" rows="2">{{ old('notes', $expense->notes) }}</textarea>
                        @error('notes')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Attachment</label>
                        <input type="file" name="attachment" class="form-control @error('attachment') is-invalid @enderror">
                        <small class="text-muted">Accepted formats: PDF, JPG, JPEG, PNG (max: 2MB)</small>
                        @if($expense->attachment)
                            <div class="mt-2">
                                <a href="{{ Storage::url($expense->attachment) }}" target="_blank" class="btn btn-sm btn-secondary">
                                    <i class="ti ti-paperclip me-1"></i> View Current Attachment
                                </a>
                            </div>
                        @endif
                        @error('attachment')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">
                            <i class="ti ti-device-floppy me-1"></i> Update Expense
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 