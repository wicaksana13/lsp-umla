@extends('superadmin.layout')

@section('title', 'Penilaian Asesmen Peserta')
@section('page_title', 'Penilaian Asesmen Peserta')

@section('content')
<div class="floating-card">
    <h2>Daftar Asesmen Peserta</h2>
    <p style="color: #64748b; margin-bottom: 20px;">Kelola dan input hasil unit kompetensi peserta uji sertifikasi.</p>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- FILTER & SEARCH BAR -->
    <div class="filter-search-container">
        <div class="search-box">
            <input type="text" id="searchInput" placeholder="Cari berdasarkan Nama atau NIM..." onkeyup="filterTable()">
        </div>
        <div class="filter-box">
            <select id="schemeFilter" onchange="filterTable()">
                <option value="">-- Semua Skema Sertifikasi --</option>
                @php
                    // Mengambil daftar skema unik secara otomatis dari data yang ada
                    $uniqueSchemes = $data->pluck('schedule.scheme')->unique('id')->filter();
                @endphp
                @foreach($uniqueSchemes as $scheme)
                    <option value="{{ strtolower($scheme->name) }}">{{ $scheme->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="table-wrap">
        <table id="assessmentTable">
            <thead>
                <tr>
                    <th>Peserta</th>
                    <th>NIM</th>
                    <th>Skema</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $item)
                <tr data-name="{{ strtolower($item->participant->name ?? '') }}" 
                    data-nim="{{ strtolower($item->participant->nim ?? '') }}" 
                    data-scheme="{{ strtolower($item->schedule->scheme->name ?? '') }}">
                    <td>{{ $item->participant->name ?? '-' }}</td>
                    <td>{{ $item->participant->nim ?? '-' }}</td>
                    <td>{{ $item->schedule->scheme->name ?? '-' }}</td>
                    <td>
                        @if($item->schedule?->date)
                            {{ \Carbon\Carbon::parse($item->schedule->date)->format('d M Y') }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if($item->status == 'menunggu' || $item->status == 'revisi')
                            <span class="status status-menunggu" style="background:#fef3c7; color:#d97706; padding:4px 8px; border-radius:4px;">Menunggu Admin</span>
                        @elseif($item->status == 'approved')
                            <span class="status status-approved" style="background:#dbeafe; color:#1e40af; padding:4px 8px; border-radius:4px;">Approved (Siap Dinilai)</span>
                        @elseif($item->status == 'kompeten')
                            <span class="status status-kompeten" style="background:#dcfce7; color:#166534; padding:4px 8px; border-radius:4px;">Kompeten</span>
                        @elseif($item->status == 'tidak_kompeten')
                            <span class="status status-tidak" style="background:#fee2e2; color:#991b1b; padding:4px 8px; border-radius:4px;">Tidak Kompeten</span>
                        @endif
                    </td>
                    <td>
                        @if($item->status == 'menunggu' || $item->status == 'revisi')
                            <!-- Belum di-ACC admin -->
                            <span style="color: #64748b; font-size: 13px; font-style: italic;">Menunggu Admin</span>
                        @elseif($item->status == 'approved')
                            <!-- Sudah di-ACC admin, asesor bisa input nilai -->
                            <a href="{{ route('superadmin.assessment.unit.create', $item->id) }}" class="btn-primary" style="padding: 6px 12px; text-decoration: none; border-radius: 4px; display: inline-block; background: #2563eb; color: white;">
                                Input Unit Kompetensi
                            </a>
                        @else
                            <!-- Sudah dinilai, tampilkan hasil -->
                            <a href="{{ route('superadmin.assessment.result', $item->id) }}" class="btn-info" style="padding: 6px 12px; text-decoration: none; border-radius: 4px; display: inline-block; background: #0ea5e9; color: white;">
                                Lihat Hasil
                            </a>
                        @endif
                    </td>
                </tr>
                @empty
                <tr id="emptyRow">
                    <td colspan="6" style="text-align:center">Belum ada peserta yang mendaftar asesmen.</td>
                </tr>
                @endforelse
                <tr id="noResultRow" style="display: none;">
                    <td colspan="6" style="text-align:center; color: #64748b; padding: 20px;">Data peserta atau skema tidak ditemukan.</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- STYLING CSS KHUSUS FILTER & SEARCH -->
<style>
    .filter-search-container {
        display: flex;
        gap: 15px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }
    .search-box, .filter-box {
        flex: 1;
        min-width: 240px;
    }
    .search-box input, .filter-box select {
        width: 100%;
        padding: 10px 14px;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        font-size: 14px;
        outline: none;
        background: #ffffff;
        box-sizing: border-box;
        transition: border-color 0.2s;
    }
    .search-box input:focus, .filter-box select:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    @media (max-width: 768px) {
        .filter-search-container {
            flex-direction: column;
        }
    }
</style>

<!-- SCRIPT JAVASCRIPT LIVE FILTER & SEARCH -->
<script>
    function filterTable() {
        let inputSearch = document.getElementById('searchInput').value.toLowerCase();
        let selectedScheme = document.getElementById('schemeFilter').value.toLowerCase();
        let table = document.getElementById('assessmentTable');
        let tr = table.getElementsByTagName('tr');
        let visibleCount = 0;

        for (let i = 1; i < tr.length; i++) {
            let row = tr[i];
            if (row.id === 'emptyRow' || row.id === 'noResultRow') continue;

            let name = row.getAttribute('data-name') || '';
            let nim = row.getAttribute('data-nim') || '';
            let scheme = row.getAttribute('data-scheme') || '';

            // Cek kecocokan pencarian nama/NIM dan pilihan skema
            let matchSearch = (name.includes(inputSearch) || nim.includes(inputSearch));
            let matchScheme = (selectedScheme === "" || scheme === selectedScheme);

            if (matchSearch && matchScheme) {
                row.style.display = "";
                visibleCount++;
            } else {
                row.style.display = "none";
            }
        }

        // Tampilkan pesan jika data tidak ditemukan
        let noResultRow = document.getElementById('noResultRow');
        if (noResultRow) {
            noResultRow.style.display = (visibleCount === 0 && tr.length > 2) ? "" : "none";
        }
    }
</script>
@endsection