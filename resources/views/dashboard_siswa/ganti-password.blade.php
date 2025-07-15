@extends('layouts.app') {{-- atau sesuaikan layoutmu --}}

@section('content')
<div class="container mt-5">
    <h2>Ganti Password</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('dashboard_siswa.password.change') }}">
        @csrf

        <div class="mb-3">
            <label for="password_baru" class="form-label">Password Baru</label>
            <input type="password" name="password_baru" id="password_baru" class="form-control" required>
            @error('password_baru')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password_baru_confirmation" class="form-label">Konfirmasi Password Baru</label>
            <input type="password" name="password_baru_confirmation" id="password_baru_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Ubah Password</button>
    </form>
</div>
@endsection
