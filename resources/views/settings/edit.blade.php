@extends('layouts.tabler')

@section('content')
<div class="container-xl py-3">
    <h3 class="mb-4"><i class="fa-solid fa-gears me-2"></i>General Settings</h3>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="card">
        <div class="card-body">
            <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Site Name <span class="text-danger">*</span></label>
                    <input type="text" name="site_name" class="form-control @error('site_name') is-invalid @enderror" value="{{ old('site_name', $settings['site_name']) }}" required>
                    @error('site_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Site Email <span class="text-danger">*</span></label>
                    <input type="email" name="site_email" class="form-control @error('site_email') is-invalid @enderror" value="{{ old('site_email', $settings['site_email']) }}" required>
                    @error('site_email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Site Logo</label>
                    @if($settings['site_logo'])
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $settings['site_logo']) }}" alt="Site Logo" style="max-height: 60px;">
                        </div>
                    @endif
                    <input type="file" name="site_logo" class="form-control @error('site_logo') is-invalid @enderror">
                    @error('site_logo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Contact Phone</label>
                    <input type="text" name="contact_phone" class="form-control @error('contact_phone') is-invalid @enderror" value="{{ old('contact_phone', $settings['contact_phone']) }}">
                    @error('contact_phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Contact Address</label>
                    <textarea name="contact_address" class="form-control @error('contact_address') is-invalid @enderror" rows="2">{{ old('contact_address', $settings['contact_address']) }}</textarea>
                    @error('contact_address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-save me-1"></i>Save Settings</button>
            </form>
        </div>
    </div>
</div>
@endsection 