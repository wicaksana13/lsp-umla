@extends('layouts.app')

@section('title','Pendaftaran Peserta')

@section('content')

<section class="registration-page">
    <div class="registration-card">
        <h2>Form Pendaftaran Peserta</h2>

        @if(session('success'))
            <div class="registration-alert">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="registration-alert" style="background:#fee2e2;color:#991b1b;">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('daftar.store') }}" class="registration-form">
            @csrf

            <div class="registration-group">
                <label>Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Masukkan nama lengkap" required>
            </div>

            <div class="registration-group">
                <label>NIM</label>
                <input type="text" name="nim" value="{{ old('nim') }}" placeholder="Masukkan NIM" required>
                @error('nim')
                    <p class="registration-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="registration-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email aktif" required>
                <small style="color: #64748b; margin-top: 6px; font-size: 13px;">
                    *Digunakan untuk mengirim username dan password akses website.
                </small>          
            </div>

            <div class="registration-group">
                <label>Nomor HP</label>
                <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Contoh: 0857xxxxxxxx">
            </div>

            <div class="registration-group">
                <label>Tanggal Lahir</label>
                <input type="date" name="birth_date" value="{{ old('birth_date') }}" required>
                <small style="color: #64748b; margin-top: 6px; font-size: 13px;">
                    *Digunakan untuk verifikasi dan otomatisasi pembuatan password (NIM + 2 Digit Tahun Lahir).
                </small>
                @error('birth_date')
                    <p class="registration-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="registration-confirm" style="margin-top: 15px;">
                <label>
                    <input type="checkbox" required>
                    Saya menyatakan data yang saya isi adalah benar.
                </label>
            </div>

            <button type="submit" class="registration-btn">
                Daftar Sekarang
            </button>
        </form>
    </div>
</section>

@endsection