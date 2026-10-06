@extends('layouts.app')

@section('title', 'Daftar Sertifikat')

@section('content')

<section class="informasi-detail">
    <div class="detail-layout">

        <!-- KONTEN UTAMA: TABEL REKAPITULASI SERTIFIKAT -->
        <div class="detail-content sertifikat-content">
            <div style="margin-bottom: 20px;">
                <h2 style="color: #1e293b; font-size: 24px; margin-bottom: 8px;">Rekapitulasi Sertifikat Kelulusan</h2>
                <p style="color: #64748b; font-size: 14px;">Jumlah sertifikat kompetensi yang diterbitkan oleh LSP UMLA berdasarkan skema dan tahun.</p>
            </div>

            <div class="table-wrap" style="overflow-x: auto; background: #ffffff; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); border: 1px solid #e2e8f0;">
                <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 14px;">
                    <thead>
                        <tr style="background: #f8fafc; color: #1e293b; border-bottom: 2px solid #e2e8f0;">
                            <th style="padding: 14px 16px; font-weight: 600; text-align: center; width: 60px;">No</th>
                            <th style="padding: 14px 16px; font-weight: 600;">Skema Sertifikasi</th>
                            <th style="padding: 14px 16px; font-weight: 600; text-align: center; width: 100px;">2026</th>
                            <th style="padding: 14px 16px; font-weight: 600; text-align: center; width: 100px;">2027</th>
                            <th style="padding: 14px 16px; font-weight: 600; text-align: center; width: 100px;">2028</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($schemes as $index => $scheme)
                            @php
                                // Menghitung total sertifikat berdasarkan tahun terbit (issued_at)
                                $count2026 = $scheme->certificates->filter(function($cert) {
                                    return $cert->issued_at && $cert->issued_at->format('Y') == '2026';
                                })->count();

                                $count2027 = $scheme->certificates->filter(function($cert) {
                                    return $cert->issued_at && $cert->issued_at->format('Y') == '2027';
                                })->count();

                                $count2028 = $scheme->certificates->filter(function($cert) {
                                    return $cert->issued_at && $cert->issued_at->format('Y') == '2028';
                                })->count();
                            @endphp
                            <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.2s;">
                                <td style="padding: 14px 16px; text-align: center; color: #64748b;">{{ $index + 1 }}</td>
                                <td style="padding: 14px 16px; font-weight: 500; color: #1e293b;">
                                    {{ $scheme->name }}
                                    <small style="display: block; color: #64748b; font-weight: normal; font-size: 12px;">Kode: {{ $scheme->code ?? '-' }}</small>
                                </td>
                                <td style="padding: 14px 16px; text-align: center;">
                                    @if($count2026 > 0)
                                        <span style="background: #dcfce7; color: #166534; padding: 4px 10px; border-radius: 6px; font-weight: 600; font-size: 13px;">{{ $count2026 }}</span>
                                    @else
                                        <span style="color: #94a3b8;">-</span>
                                    @endif
                                </td>
                                <td style="padding: 14px 16px; text-align: center;">
                                    @if($count2027 > 0)
                                        <span style="background: #dcfce7; color: #166534; padding: 4px 10px; border-radius: 6px; font-weight: 600; font-size: 13px;">{{ $count2027 }}</span>
                                    @else
                                        <span style="color: #94a3b8;">-</span>
                                    @endif
                                </td>
                                <td style="padding: 14px 16px; text-align: center;">
                                    @if($count2028 > 0)
                                        <span style="background: #dcfce7; color: #166534; padding: 4px 10px; border-radius: 6px; font-weight: 600; font-size: 13px;">{{ $count2028 }}</span>
                                    @else
                                        <span style="color: #94a3b8;">-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="text-align: center; padding: 30px; color: #64748b; font-style: italic;">
                                    Belum ada data skema atau sertifikat yang tersedia.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- SIDEBAR BERITA / PENGUMUMAN -->
        <div class="detail-sidebar">
            <a href="{{ route('pengumuman') }}" class="sidebar-button">
                Pengumuman/Berita →
            </a>

            @forelse($berita as $item)
                <div class="sidebar-news">
                    <h3>{{ $item->title }}</h3>
                    <span>
                        {{ $item->published_at ? $item->published_at->format('d F Y') : '-' }}
                    </span>
                    <p>{{ $item->excerpt }}</p>
                    <a href="{{ route('pengumuman.detail', $item->id) }}">
                        Selengkapnya →
                    </a>
                </div>
            @empty
                <div class="sidebar-news">
                    <h3>Belum Ada Berita</h3>
                    <p>Informasi terbaru belum tersedia.</p>
                </div>
            @endforelse
        </div>

    </div>
</section>

@endsection