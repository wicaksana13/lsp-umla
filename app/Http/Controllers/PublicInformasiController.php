<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use App\Models\Announcement;
use App\Models\CertificationScheme;

class PublicInformasiController extends Controller
{
    public function pengumuman()
    {
        $berita = Announcement::where(
            'is_published',
            true
        )
        ->latest('published_at')
        ->get();

        return view(
            'informasi.pengumuman',
            compact('berita')
        );
    }

    public function detail(
        Announcement $announcement
    )
    {
        abort_if(
            !$announcement->is_published,
            404
        );

        return view(
            'informasi.detail',
            compact('announcement')
        );
    }

    public function prosedur()
    {
        $berita = $this->berita();

        $settings = SiteSetting::pluck(
            'value',
            'key'
        );

        return view(
            'informasi.prosedur',
            compact(
                'berita',
                'settings'
            )
        );
    }

    public function biaya()
    {
        $berita = $this->berita();

        $settings = SiteSetting::pluck(
            'value',
            'key'
        );

        return view(
            'informasi.biaya',
            compact(
                'berita',
                'settings'
            )
        );
    }

    public function tuk()
    {
        $berita = $this->berita();

        $settings = SiteSetting::pluck(
            'value',
            'key'
        );

        return view(
            'informasi.tuk',
            compact(
                'berita',
                'settings'
            )
        );
    }

    public function asesor()
    {
        $berita = $this->berita();

        $settings = SiteSetting::pluck(
            'value',
            'key'
        );

        return view(
            'informasi.asesor',
            compact(
                'berita',
                'settings'
            )
        );
    }

    public function sertifikat()
    {
        $berita = $this->berita();

        $settings = SiteSetting::pluck(
            'value',
            'key'
        );

        // Mengambil data skema sertifikasi beserta relasi sertifikatnya untuk rekap tahunan
        $schemes = CertificationScheme::with('certificates')->get();

        return view(
            'informasi.sertifikat',
            compact(
                'berita',
                'settings',
                'schemes'
            )
        );
    }

    private function berita()
    {
        return Announcement::where(
            'is_published',
            true
        )
        ->orderBy(
            'published_at',
            'desc'
        )
        ->take(3)
        ->get();
    }
}