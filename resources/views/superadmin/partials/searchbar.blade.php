<form class="toolbar" method="GET">
    <input type="search" name="q" value="{{ request('q') }}" placeholder="Cari data...">
    <button class="btn btn-outline" type="submit">Cari</button>
    <a class="btn btn-primary" href="{{ $createUrl }}">+ Tambah Data</a>
</form>
