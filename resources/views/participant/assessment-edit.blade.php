@extends('layouts.participant')

@section('title', 'Perbaiki Pendaftaran Asesmen')
@section('page_title', 'Perbaikan Berkas Asesmen')

@section('content')
<div class="participant-panel">
    <div class="panel-head">
        <div>
            <h2>Form Perbaikan Berkas Asesmen</h2>
            <p>Skema: <b>{{ $assessment->schedule->scheme->name }}</b> ({{ $assessment->schedule->scheme->code }})</p>
        </div>
    </div>

    <!-- Tampilkan Catatan Revisi dari Admin -->
    @if($assessment->note)
        <div style="background: #fffbeb; border: 1px solid #fde68a; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
            <strong style="color: #92400e; display: block; margin-bottom: 5px;">Catatan Revisi dari Admin:</strong>
            <p style="margin: 0; color: #b45309; font-size: 14px;">{{ $assessment->note }}</p>
        </div>
    @endif

    @if($errors->any())
        <div class="alert-error">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('peserta.assessment.update', $assessment->id) }}" enctype="multipart/form-data" class="panel form-card">
        @csrf
        @method('PUT')

        <div class="form-grid">

            <!-- Nama Lengkap -->
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" value="{{ auth()->user()->name }}" disabled class="input-disabled">
                <small class="form-hint">*Diambil otomatis dari data profil akun Anda.</small>
            </div>

            <!-- NIM -->
            <div class="form-group">
                <label>NIM</label>
                <input type="text" value="{{ auth()->user()->nim }}" disabled class="input-disabled">
                <small class="form-hint">*Diambil otomatis dari data profil akun Anda.</small>
            </div>

            <!-- Email -->
            <div class="form-group">
                <label>Email</label>
                <input type="email" value="{{ auth()->user()->email }}" disabled class="input-disabled">
                <small class="form-hint">*Diambil otomatis dari data profil akun Anda.</small>
            </div>

            <!-- Nomor HP -->
            <div class="form-group">
                <label>Nomor HP / WhatsApp</label>
                <input type="text" value="{{ auth()->user()->phone ?? '-' }}" disabled class="input-disabled">
                <small class="form-hint">*Diambil otomatis dari data profil akun Anda.</small>
            </div>

            <!-- Program Studi -->
            <div class="form-group">
                <label>Program Studi / Jurusan <span class="required">*</span></label>
                <input type="text" name="program_studi" value="{{ old('program_studi', $assessment->program_studi) }}" placeholder="Contoh: Teknik Informatika" required class="form-control">
            </div>

            <!-- Scan KTP -->
            <div class="form-group">
                <label>Scan KTP (Opsional / Upload baru jika ingin mengganti)</label>
                @if($assessment->ktp_scan)
                    <div style="margin-bottom: 5px; font-size: 13px;">
                        File saat ini: <a href="{{ asset('storage/' . $assessment->ktp_scan) }}" target="_blank" style="color: #2563eb;">Lihat KTP</a>
                    </div>
                @endif
                <input type="file" name="ktp_scan" accept=".jpg,.jpeg,.png,.pdf" class="form-file">
                <small class="form-hint">Format JPG, PNG, atau PDF (Maksimal 2MB). Biarkan kosong jika tidak ingin mengubah.</small>
            </div>

            <!-- Scan Ijazah Terakhir -->
            <div class="form-group">
                <label>Scan Ijazah Terakhir (Opsional / Upload baru jika ingin mengganti)</label>
                @if($assessment->diploma_scan)
                    <div style="margin-bottom: 5px; font-size: 13px;">
                        File saat ini: <a href="{{ asset('storage/' . $assessment->diploma_scan) }}" target="_blank" style="color: #2563eb;">Lihat Ijazah</a>
                    </div>
                @endif
                <input type="file" name="diploma_scan" accept=".jpg,.jpeg,.png,.pdf" class="form-file">
                <small class="form-hint">Format JPG, PNG, atau PDF (Maksimal 2MB). Biarkan kosong jika tidak ingin mengubah.</small>
            </div>

            <!-- Bukti Pembayaran -->
            <div class="form-group">
                <label>Bukti Transfer / Screenshot SIAK Pembayaran (Opsional / Upload baru jika ingin mengganti)</label>
                @if($assessment->payment_proof)
                    <div style="margin-bottom: 5px; font-size: 13px;">
                        File saat ini: <a href="{{ asset('storage/' . $assessment->payment_proof) }}" target="_blank" style="color: #2563eb;">Lihat Bukti Pembayaran</a>
                    </div>
                @endif
                <input type="file" name="payment_proof" accept=".jpg,.jpeg,.png,.pdf" class="form-file">
                <small class="form-hint">Format JPG, PNG, atau PDF (Maksimal 2MB). Biarkan kosong jika tidak ingin mengubah.</small>
            </div>

            <!-- Checkbox Persetujuan -->
            <div class="form-group-checkbox">
                <label class="checkbox-label">
                    <input type="checkbox" name="agreement" value="1" required>
                    <span>Saya memahami bahwa semua dokumen yang saya unggah adalah benar dan sah.</span>
                </label>
            </div>

        </div>

        <div class="form-actions">
            <a href="{{ route('peserta.assessment') }}" class="btn btn-outline">Batal</a>
            <button type="submit" class="btn btn-primary">Kirim Ulang Perbaikan</button>
        </div>
    </form>
</div>

<!-- CSS STYLING -->
<style>
    .form-card {
        background: #ffffff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        width: 100%;
        box-sizing: border-box;
    }

    .form-grid {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .form-group label {
        font-weight: 600;
        color: #1e293b;
        font-size: 14px;
    }

    .required {
        color: #ef4444;
    }

    .form-control, .input-disabled, .form-file {
        width: 100%;
        padding: 10px 14px;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        font-size: 14px;
        outline: none;
        transition: border-color 0.2s;
        box-sizing: border-box;
    }

    .form-control:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .input-disabled {
        background-color: #f1f5f9;
        color: #64748b;
        cursor: not-allowed;
    }

    .form-file {
        padding: 8px;
        background: #f8fafc;
        cursor: pointer;
    }

    .form-hint {
        font-size: 12px;
        color: #64748b;
    }

    .form-group-checkbox {
        margin-top: 5px;
    }

    .checkbox-label {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        cursor: pointer;
        font-size: 14px;
        color: #334155;
        font-weight: 500;
    }

    .checkbox-label input[type="checkbox"] {
        width: 18px;
        height: 18px;
        margin-top: 2px;
        cursor: pointer;
        accent-color: #1e1b4b;
        flex-shrink: 0;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #e2e8f0;
    }

    .alert-error {
        background: #fee2e2;
        color: #991b1b;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-size: 14px;
    }

    .alert-error ul {
        margin: 0;
        padding-left: 20px;
    }

    @media (max-width: 768px) {
        .form-card {
            padding: 15px !important;
        }
        .form-actions {
            flex-direction: column-reverse;
            gap: 8px;
        }
        .form-actions .btn {
            width: 100%;
            text-align: center;
        }
    }
</style>
@endsection