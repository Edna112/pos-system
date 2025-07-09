@extends('layouts.tabler')

@section('content')
<div class="container-xl py-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">
            <i class="ti ti-receipt me-2"></i>Create Expense
        </h3>
        <a href="{{ route('expenses.index') }}" class="btn btn-link">
            <i class="ti ti-arrow-left"></i> Back to Expenses
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('expenses.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Amount <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" name="amount" class="form-control @error('amount') is-invalid @enderror" value="{{ old('amount') }}" required>
                        @error('amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Category</label>
                        <select name="category" class="form-select @error('category') is-invalid @enderror">
                            <option value="">Select Category</option>
                            <option value="Office Supplies">Office Supplies</option>
                            <option value="Utilities">Utilities</option>
                            <option value="Rent">Rent</option>
                            <option value="Salaries">Salaries</option>
                            <option value="Marketing">Marketing</option>
                            <option value="Travel">Travel</option>
                            <option value="Maintenance">Maintenance</option>
                            <option value="Others">Others</option>
                        </select>
                        @error('category')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Payment Method</label>
                        <select name="payment_method" class="form-select @error('payment_method') is-invalid @enderror">
                            <option value="">Select Payment Method</option>
                            <option value="Cash">Cash</option>
                            <option value="Bank Transfer">Bank Transfer</option>
                            <option value="Credit Card">Credit Card</option>
                            <option value="Mobile Money">Mobile Money</option>
                            <option value="Check">Check</option>
                        </select>
                        @error('payment_method')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Expense Date <span class="text-danger">*</span></label>
                        <input type="date" name="expense_date" class="form-control @error('expense_date') is-invalid @enderror" value="{{ old('expense_date', date('Y-m-d')) }}" required>
                        @error('expense_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Reference Number</label>
                        <input type="text" name="reference_number" class="form-control @error('reference_number') is-invalid @enderror" value="{{ old('reference_number') }}">
                        @error('reference_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label">Notes</label>
                        <textarea name="notes" class="form-control @error('notes') is-invalid @enderror" rows="2">{{ old('notes') }}</textarea>
                        @error('notes')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Attachment</label>
                        <input type="file" name="attachment" class="form-control @error('attachment') is-invalid @enderror">
                        <small class="text-muted">Accepted formats: PDF, JPG, JPEG, PNG (max: 2MB)</small>
                        @error('attachment')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">
                            <i class="ti ti-device-floppy me-1"></i> Save Expense
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 