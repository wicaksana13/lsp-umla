@extends('superadmin.layout')

@section('title','Hasil Asesmen')
@section('page_title','Hasil Asesmen')

@section('content')
<section class="panel form-card" style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); max-width: 900px; margin: 0 auto;">

    <div class="section-heading" style="margin-bottom: 25px;">
        <h2 style="margin: 0 0 5px 0; color: #1e293b;">Hasil Asesmen Peserta</h2>
        <p style="margin: 0; color: #64748b; font-size: 14px;">Detail hasil evaluasi sertifikasi peserta.</p>
    </div>

    <div class="detail-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; background: #f8fafc; padding: 20px; border-radius: 8px; margin-bottom: 25px;">
        <div>
            <b style="display: block; color: #64748b; font-size: 12px; margin-bottom: 3px;">NAMA PESERTA</b>
            <span style="color: #1e293b; font-weight: 600;">{{ $assessment->participant->name ?? '-' }}</span>
        </div>

        <div>
            <b style="display: block; color: #64748b; font-size: 12px; margin-bottom: 3px;">NIM</b>
            <span style="color: #1e293b; font-weight: 600;">{{ $assessment->participant->nim ?? '-' }}</span>
        </div>

        <div>
            <b style="display: block; color: #64748b; font-size: 12px; margin-bottom: 3px;">SKEMA SERTIFIKASI</b>
            <span style="color: #1e293b; font-weight: 600;">{{ $assessment->schedule->scheme->name ?? '-' }}</span>
        </div>

        <div>
            <b style="display: block; color: #64748b; font-size: 12px; margin-bottom: 3px;">TANGGAL ASESMEN</b>
            <span style="color: #1e293b; font-weight: 600;">
                {{ $assessment->schedule?->date ? \Carbon\Carbon::parse($assessment->schedule->date)->format('d M Y') : '-' }}
            </span>
        </div>

        <div>
            <b style="display: block; color: #64748b; font-size: 12px; margin-bottom: 3px;">TUK</b>
            <span style="color: #1e293b; font-weight: 600;">{{ $assessment->schedule->tuk->name ?? '-' }}</span>
        </div>

        <div>
            <b style="display: block; color: #64748b; font-size: 12px; margin-bottom: 3px;">STATUS AKHIR</b>
            <span class="badge" style="display: inline-block; padding: 4px 10px; border-radius: 4px; font-weight: bold; background: {{ $assessment->status=='kompeten' ? '#dcfce7' : '#fee2e2' }}; color: {{ $assessment->status=='kompeten' ? '#166534' : '#991b1b' }};">
                {{ str_replace('_',' ', ucfirst($assessment->status)) }}
            </span>
        </div>
    </div>

    <h3 class="result-title" style="margin-bottom: 15px; font-size: 16px; color: #1e293b;">Hasil Unit Kompetensi</h3>

    <div class="table-wrap" style="margin-bottom: 25px;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #f8fafc; text-align: left;">
                    <th style="padding: 12px; border-bottom: 1px solid #e2e8f0; font-size: 13px;">Kode Unit</th>
                    <th style="padding: 12px; border-bottom: 1px solid #e2e8f0; font-size: 13px;">Nama Unit Kompetensi</th>
                    <th style="padding: 12px; border-bottom: 1px solid #e2e8f0; font-size: 13px;">Hasil</th>
                </tr>
            </thead>
            <tbody>
                @forelse($assessment->units as $unit)
                <tr>
                    <td style="padding: 12px; border-bottom: 1px solid #f1f5f9; font-size: 13px;">{{ $unit->code }}</td>
                    <td style="padding: 12px; border-bottom: 1px solid #f1f5f9; font-size: 13px;">{{ $unit->unit_name }}</td>
                    <td style="padding: 12px; border-bottom: 1px solid #f1f5f9; font-size: 13px;">
                        @if($unit->result=='kompeten')
                            <span class="badge success" style="background: #dcfce7; color: #166534; padding: 4px 8px; border-radius: 4px; font-size: 12px;">Kompeten</span>
                        @else
                            <span class="badge danger" style="background: #fee2e2; color: #991b1b; padding: 4px 8px; border-radius: 4px; font-size: 12px;">Tidak Kompeten</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="empty" style="text-align: center; padding: 20px; color: #64748b;">Belum ada hasil unit kompetensi.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <a href="{{ route('superadmin.assessment.index') }}" class="btn btn-outline" style="padding: 10px 20px; background: #e2e8f0; color: #334155; text-decoration: none; border-radius: 6px; font-weight: 600; display: inline-block;">
        Kembali
    </a>

</section>
@endsection