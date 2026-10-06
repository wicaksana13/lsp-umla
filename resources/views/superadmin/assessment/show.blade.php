@extends('superadmin.layout')

@section('content')
<div class="floating-card" style="max-width: 800px; margin: 0 auto;">
    <h2>Detail Pendaftaran Asesmen Peserta</h2>
    <p style="color: #64748b; margin-bottom: 20px;">Periksa kelengkapan dokumen peserta di bawah ini sebelum melakukan persetujuan (Approve) atau meminta revisi.</p>

    <!-- Informasi Peserta -->
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 20px; background: #f8fafc; padding: 20px; border-radius: 8px;">
        <div>
            <strong>Nama Lengkap:</strong>
            <p>{{ $assessment->participant->name ?? '-' }}</p>
        </div>
        <div>
            <strong>NIM:</strong>
            <p>{{ $assessment->participant->nim ?? '-' }}</p>
        </div>
        <div>
            <strong>Email:</strong>
            <p>{{ $assessment->participant->email ?? '-' }}</p>
        </div>
        <div>
            <strong>No HP / WhatsApp:</strong>
            <p>{{ $assessment->participant->phone ?? '-' }}</p>
        </div>
        <div>
            <strong>Program Studi:</strong>
            <p>{{ $assessment->program_studi ?? '-' }}</p>
        </div>
        <div>
            <strong>Skema Sertifikasi:</strong>
            <p>{{ $assessment->schedule->scheme->name ?? '-' }}</p>
        </div>
    </div>

    <!-- Dokumen Lampiran -->
    <h3 style="margin-bottom: 15px;">Dokumen Lampiran Peserta</h3>
    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px; margin-bottom: 30px;">
        <div style="border: 1px solid #cbd5e1; padding: 15px; border-radius: 8px; text-align: center;">
            <strong>Scan KTP</strong>
            <div style="margin: 10px 0;">
                @if($assessment->ktp_scan)
                    <a href="{{ asset('storage/' . $assessment->ktp_scan) }}" target="_blank" class="btn-primary" style="padding: 6px 10px; font-size: 12px; text-decoration: none; border-radius: 4px; display: inline-block;">Lihat / Unduh</a>
                @else
                    <span style="color: red; font-size: 13px;">Tidak ada file</span>
                @endif
            </div>
        </div>

        <div style="border: 1px solid #cbd5e1; padding: 15px; border-radius: 8px; text-align: center;">
            <strong>Scan Ijazah</strong>
            <div style="margin: 10px 0;">
                @if($assessment->diploma_scan)
                    <a href="{{ asset('storage/' . $assessment->diploma_scan) }}" target="_blank" class="btn-primary" style="padding: 6px 10px; font-size: 12px; text-decoration: none; border-radius: 4px; display: inline-block;">Lihat / Unduh</a>
                @else
                    <span style="color: red; font-size: 13px;">Tidak ada file</span>
                @endif
            </div>
        </div>

        <div style="border: 1px solid #cbd5e1; padding: 15px; border-radius: 8px; text-align: center;">
            <strong>Bukti Pembayaran</strong>
            <div style="margin: 10px 0;">
                @if($assessment->payment_proof)
                    <a href="{{ asset('storage/' . $assessment->payment_proof) }}" target="_blank" class="btn-primary" style="padding: 6px 10px; font-size: 12px; text-decoration: none; border-radius: 4px; display: inline-block;">Lihat / Unduh</a>
                @else
                    <span style="color: red; font-size: 13px;">Tidak ada file</span>
                @endif
            </div>
        </div>
    </div>

    <!-- Form Aksi: Approve atau Kirim Revisi -->
    @if($assessment->status == 'menunggu' || $assessment->status == 'revisi')
        <form method="POST" action="{{ route('superadmin.assessment.revise', $assessment->id) }}" style="background: #fffbeb; padding: 20px; border-radius: 8px; border: 1px solid #fde68a; margin-bottom: 20px;">
            @csrf
            @method('PATCH')
            <h4 style="margin-bottom: 10px; color: #92400e;">Form Catatan Revisi</h4>
            <div style="margin-bottom: 15px;">
                <textarea name="note" rows="3" placeholder="Tuliskan bagian dokumen atau data yang perlu direvisi oleh peserta..." required style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; box-sizing: border-box;">{{ old('note', $assessment->note) }}</textarea>
            </div>
            <button type="submit" style="padding: 8px 16px; background: #d97706; color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: bold;">
                Kirim Catatan Revisi
            </button>
        </form>
    @endif

    <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #e2e8f0; padding-top: 20px;">
        <a href="{{ route('superadmin.assessment.index') }}" class="btn-secondary" style="padding: 10px 15px; text-decoration: none; background: #e2e8f0; color: #334155; border-radius: 6px;">Kembali</a>

        @if($assessment->status == 'menunggu' || $assessment->status == 'revisi')
            <form method="POST" action="{{ route('superadmin.assessment.approve', $assessment->id) }}">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn-success" style="padding: 10px 20px; background: #16a34a; color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: bold;">
                    Approve Pendaftaran
                </button>
            </form>
        @else
            <span style="color: #16a34a; font-weight: bold;">Pendaftaran Telah Disetujui (Approved)</span>
        @endif
    </div>
</div>
@endsection