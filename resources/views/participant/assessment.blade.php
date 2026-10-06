@extends('layouts.participant')

@section('title','Asesmen Saya')
@section('page_title','Asesmen Saya')

@section('content')

<div class="participant-panel">

    @if(session('success'))
    <div style="background: #dcfce7; color: #166534; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 14px;">
        {{ session('success') }}
    </div>
    @endif

    <div class="panel-head">
        <div>
            <h2>Riwayat Asesmen</h2>
            <p>Informasi proses sertifikasi yang telah Anda ikuti.</p>
        </div>
    </div>

    <div class="assessment-list">

        @forelse($asesmen as $item)

        <div class="assessment-card" style="background: #ffffff; padding: 20px; border-radius: 12px; margin-bottom: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">

            <div class="assessment-header" style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 15px;">
                <div>
                    <h3 style="margin: 0 0 5px 0; font-size: 18px; color: #1e293b;">
                        {{ $item->schedule->scheme->name ?? '-' }}
                    </h3>
                    <p style="margin: 0; color: #64748b; font-size: 14px;">
                        Kode: {{ $item->schedule->scheme->code ?? '-' }}
                    </p>
                </div>

                <div>
                    @if($item->status == 'kompeten')
                        <span class="badge success" style="background: #dcfce7; color: #166534; padding: 6px 12px; border-radius: 6px; font-weight: 600;">Kompeten</span>
                    @elseif($item->status == 'tidak_kompeten')
                        <span class="badge danger" style="background: #fee2e2; color: #991b1b; padding: 6px 12px; border-radius: 6px; font-weight: 600;">Tidak Kompeten</span>
                    @elseif($item->status == 'approved')
                        <span class="badge info" style="background: #dbeafe; color: #1e40af; padding: 6px 12px; border-radius: 6px; font-weight: 600;">Approved</span>
                    @elseif($item->status == 'revisi')
                        <span class="badge warning" style="background: #fef3c7; color: #d97706; padding: 6px 12px; border-radius: 6px; font-weight: 600;">Perlu Revisi</span>
                    @else
                        <span class="badge warning" style="background: #fef3c7; color: #b45309; padding: 6px 12px; border-radius: 6px; font-weight: 600;">Menunggu Approval</span>
                    @endif
                </div>
            </div>

            <!-- TAMPILKAN CATATAN REVISI JIKA STATUS REVISI -->
            @if($item->status == 'revisi')
            <div style="background: #fffbeb; border: 1px solid #fde68a; padding: 15px; border-radius: 8px; margin-bottom: 15px;">
                <strong style="color: #92400e; display: block; margin-bottom: 5px;">Catatan Revisi dari Admin:</strong>
                <p style="margin: 0; color: #b45309; font-size: 14px;">{{ $item->note }}</p>
                
                <div style="margin-top: 12px;">
                    <a href="{{ route('peserta.assessment.edit', $item->id) }}" class="btn btn-primary" style="background: #d97706; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-size: 13px; font-weight: bold; display: inline-block;">
                        Perbaiki Berkas Sekarang
                    </a>
                </div>
            </div>
            @endif

            <div class="assessment-info" style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; padding: 15px 0; border-top: 1px solid #f1f5f9; border-bottom: 1px solid #f1f5f9; margin-bottom: 15px;">
                <div>
                    <b style="display: block; color: #64748b; font-size: 12px; margin-bottom: 3px;">TANGGAL</b>
                    <span style="color: #334155; font-weight: 500;">
                        {{ $item->schedule->date ? \Carbon\Carbon::parse($item->schedule->date)->format('d M Y') : '-' }}
                    </span>
                </div>

                <div>
                    <b style="display: block; color: #64748b; font-size: 12px; margin-bottom: 3px;">TEMPAT UJI KOMPETENSI (TUK)</b>
                    <span style="color: #334155; font-weight: 500;">
                        {{ $item->schedule->tuk->name ?? '-' }}
                    </span>
                </div>
            </div>

            @if($item->units->count())
            <div class="unit-summary">
                <h4 style="margin: 0 0 10px 0; font-size: 15px; color: #1e293b;">Hasil Unit Kompetensi</h4>

                <div class="table-wrap">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="background: #f8fafc; text-align: left;">
                                <th style="padding: 10px; border-bottom: 1px solid #e2e8f0; font-size: 13px;">Kode</th>
                                <th style="padding: 10px; border-bottom: 1px solid #e2e8f0; font-size: 13px;">Unit Kompetensi</th>
                                <th style="padding: 10px; border-bottom: 1px solid #e2e8f0; font-size: 13px;">Hasil</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($item->units as $unit)
                            <tr>
                                <td style="padding: 10px; border-bottom: 1px solid #f1f5f9; font-size: 13px;">{{ $unit->code }}</td>
                                <td style="padding: 10px; border-bottom: 1px solid #f1f5f9; font-size: 13px;">{{ $unit->unit_name }}</td>
                                <td style="padding: 10px; border-bottom: 1px solid #f1f5f9; font-size: 13px;">
                                    @if($unit->result=='kompeten')
                                        <span class="badge success" style="background: #dcfce7; color: #166534; padding: 4px 8px; border-radius: 4px; font-size: 11px;">Kompeten</span>
                                    @else
                                        <span class="badge danger" style="background: #fee2e2; color: #991b1b; padding: 4px 8px; border-radius: 4px; font-size: 11px;">Tidak Kompeten</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @else
            <div class="empty-small" style="color: #64748b; font-size: 13px; font-style: italic;">
                Unit kompetensi belum tersedia (Menunggu penilaian asesor).
            </div>
            @endif

        </div>

        @empty

        <div class="empty" style="text-align: center; padding: 40px; background: white; border-radius: 12px;">
            <h3 style="color: #1e293b; margin-bottom: 8px;">Belum Ada Asesmen</h3>
            <p style="color: #64748b; margin: 0;">Anda belum melakukan pendaftaran asesmen.</p>
        </div>

        @endforelse

    </div>

</div>

@endsection