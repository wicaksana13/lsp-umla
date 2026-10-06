@extends('superadmin.layout')

@section('title', $item->exists ? 'Edit Peserta' : 'Tambah Peserta')
@section('page_title', $item->exists ? 'Edit Akun Peserta' : 'Tambah Akun Peserta')

@section('content')
<form 
method="POST"
enctype="multipart/form-data"
class="panel form-card"
action="{{ $item->exists ? route('superadmin.peserta.update', $item) : route('superadmin.peserta.store') }}">

@csrf

@if($item->exists)
    @method('PUT')
@endif

<div class="form-grid">

    <label>
        Foto Profil
        @if($item->photo)
            <div style="margin:10px 0">
                <img src="{{ asset('storage/'.$item->photo) }}" width="100" height="100" style="border-radius:50%; object-fit:cover;">
            </div>
        @endif
        <input type="file" name="photo" accept="image/*">
        <small>Format JPG/PNG maksimal 2MB</small>
    </label>

    <label>
        Nama Lengkap
        <input type="text" name="name" value="{{ old('name', $item->name) }}" required>
    </label>

    <label>
        NIM
        <input name="nim" value="{{ old('nim', $item->nim) }}" required>
    </label>

    <label>
        Email
        <input type="email" name="email" value="{{ old('email', $item->email) }}" required>
    </label>

    <label>
        Nomor HP
        <input name="phone" value="{{ old('phone', $item->phone) }}">
    </label>

    <!-- PASSWORD DENGAN VALUE DARI DATABASE & TOMBOL HIDE / SHOW -->
    <label style="position: relative;">
        Password
        <div style="position: relative;">
            <input type="password" name="password" id="passwordField" value="{{ old('password', $item->password) }}" style="width: 100%; padding-right: 45px;">
            <button type="button" onclick="togglePassword('passwordField', 'eyeIcon1')" style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); border: none; background: transparent; cursor: pointer; color: #64748b; display: flex; align-items: center; justify-content: center;">
                <svg id="eyeIcon1" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.478 0-8.268-2.943-9.542-7z" />
                </svg>
            </button>
        </div>
        <small>Kosongkan jika tidak ingin mengganti password</small>
    </label>

    <label>
        Status
        <select name="is_active">
            <option value="1" @selected(old('is_active', $item->is_active ?? true) == 1)>Aktif</option>
            <option value="0" @selected(old('is_active', $item->is_active) == 0)>Nonaktif</option>
        </select>
    </label>

</div>

<div class="form-actions">
    <a href="{{ route('superadmin.peserta.index') }}" class="btn btn-outline">Batal</a>
    <button class="btn btn-primary">Simpan Peserta</button>
</div>

</form>

<!-- SCRIPT UNTUK TOGGLE HIDE/SHOW PASSWORD -->
<script>
    function togglePassword(fieldId, iconId) {
        const field = document.getElementById(fieldId);
        const icon = document.getElementById(iconId);

        if (field.type === "password") {
            field.type = "text";
            icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />`;
        } else {
            field.type = "password";
            icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.478 0-8.268-2.943-9.542-7z" />`;
        }
    }
</script>
@endsection