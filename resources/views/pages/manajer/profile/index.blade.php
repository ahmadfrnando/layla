@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex align-items-center">
                    <p class="mb-0 fs-4 fw-bold">Ubah Profile</p>
                </div>
            </div>
            <form id="ubahProfile">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <input class="form-control" style="display: none;" value="{{ $user->role_id }}" name="role_id" readonly>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="form-control-label">Nama</label>
                                <input class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" type="text">
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="username" class="form-control-label">Username</label>
                                <input class="form-control @error('username') is-invalid @enderror" value="{{ old('username', $user->username) }}" name="username" type="text">
                                @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password" class="form-control-label">Password</label>
                                <input class="form-control @error('password') is-invalid @enderror" value="{{ old('password', $user->password) }}" name="password" type="password">
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password_confirmation" class="form-control-label">Konfirmasi Password</label>
                                <input class="form-control @error('password_confirmation') is-invalid @enderror" value="{{ old('password_confirmation') }}" name="password_confirmation" type="password">
                                @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary btn-sm">Simpan Perubahan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@push('scripts')
<script type="text/javascript">
    $(function() {
        let formSelector = '#ubahProfile';
        let actionUrl = "{{ route('admin.profile.update', $user->id) }}";
        let successMessage = 'Data berhasil diubah!';
        let redirectUrl = "{{ route('admin.profile.index') }}";

        submitFormAjax(formSelector, actionUrl, successMessage, redirectUrl);
    });
</script>
@endpush
@endsection