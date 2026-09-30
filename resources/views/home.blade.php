@extends('layouts.app')


@section('title','LSP UMLA')


@section('content')



<!-- ================= HERO ================= -->

<section class="page-hero page-hero--home">


    <img
        src="{{ asset('assets/gedung.png') }}"
        alt="Gedung Universitas Muhammadiyah Lamongan"
        class="page-hero__image"
    >



    <div class="page-hero__content">


        <h1 class="page-hero__title">

            {!! nl2br(
                $settings['hero_title']
                ?? "LEMBAGA\nSERTIFIKASI\nPROFESI"
            ) !!}

        </h1>



        <p class="page-hero__subtitle">

            {!! nl2br(
                $settings['hero_subtitle']
                ?? "Universitas Muhammadiyah\nLamongan"
            ) !!}

        </p>



       <a href="{{ route('login') }}" class="hero-button">

    Akses Sekarang

    <span class="btn-arrow"></span>

</a>


    </div>


</section>







<!-- ================= STATISTIK ================= -->


<section class="home-stat">


    <div class="home-stat-item">


        <div class="stat-number">
            {{ $jumlahSkema ?? 0 }}
        </div>


        <div>

            <h3>
                Skema
                <br>
                Sertifikasi
            </h3>

        </div>


    </div>





    <div class="home-stat-item">


        <div class="stat-number">
            {{ $jumlahAsesor ?? 0 }}
        </div>


        <div>

            <h3>
                Asesor
                <br>
                Kompetensi
            </h3>

        </div>


    </div>






    <div class="home-stat-item">


        <div class="stat-number">
            {{ $jumlahTuk ?? 0 }}
        </div>


        <div>

            <h3>
                Tempat Uji
                <br>
                Kompetensi
            </h3>

        </div>


    </div>






    <div class="home-stat-item last">


        <div>


            <h2>
                {{ $jumlahSertifikat ?? 0 }}
            </h2>


            <h3>
                Pemegang
                <br>
                Sertifikat
            </h3>


        </div>


    </div>


</section>









<!-- ================= ASPEK PENILAIAN ================= -->


<section class="aspek-section">


    <h2>
        Aspek Penilaian Sertifikasi
    </h2>



    <p>
        Berikut ini tiga aspek utama dalam proses asesmen kompetensi
    </p>





    <div class="aspek-list">



        @php

            $assessment = $settings['assessment_aspects'] ?? '';

            $aspects = array_filter(
                explode("\n", $assessment)
            );

        @endphp





        @if(count($aspects) > 0)



            @foreach($aspects as $aspect)



                @php

                    $data = explode('|', $aspect);

                @endphp




                <div class="aspek-card">


                    <div class="aspek-icon">
                        ▦
                    </div>



                    <h3>
                        {{ $data[0] ?? '' }}
                    </h3>



                    <p>
                        {{ $data[1] ?? '' }}
                    </p>



                </div>



            @endforeach




        @else




            <div class="aspek-card">


                <div class="aspek-icon">
                    ▦
                </div>


                <h3>
                    Pengetahuan
                </h3>


                <p>
                    Menilai pemahaman teori dan konsep yang relevan dengan bidang kompetensi.
                </p>


            </div>





            <div class="aspek-card">


                <div class="aspek-icon">
                    ▦
                </div>


                <h3>
                    Keterampilan
                </h3>


                <p>
                    Menilai kemampuan peserta dalam menerapkan kompetensi sesuai standar.
                </p>


            </div>





            <div class="aspek-card">


                <div class="aspek-icon">
                    ▦
                </div>


                <h3>
                    Sikap Kerja
                </h3>


                <p>
                    Menilai perilaku kerja dan profesionalisme peserta.
                </p>


            </div>




        @endif



    </div>



</section>









<!-- ================= BERITA ================= -->


<section class="berita-home">


    <h2>
        Pengumuman dan Berita
    </h2>



    <p>
        Segala pengumuman dan informasi mengenai sertifikasi profesi
    </p>






    <div class="berita-list">





        @forelse($berita as $item)



            <div class="berita-item">





                @if($item->image_path)



                    <img
                        src="{{ asset('storage/'.$item->image_path) }}"
                        alt="{{ $item->title }}"
                    >



                @else



                    <img
                        src="{{ asset('assets/berita.jpeg') }}"
                        alt="Berita LSP UMLA"
                    >



                @endif






                <h3>
                    {{ $item->title }}
                </h3>





                <span>


                    {{ $item->published_at
                        ? $item->published_at->format('d F Y')
                        : '-'
                    }}


                </span>






                <p>

                    {{ $item->excerpt }}

                </p>






                <a href="{{ route('pengumuman.detail',$item->id) }}">
    Selengkapnya →
</a>




            </div>





        @empty





            <div class="berita-item">


                <img
                    src="{{ asset('assets/berita.jpeg') }}"
                    alt="Berita"
                >


                <h3>
                    Belum Ada Pengumuman
                </h3>


                <p>
                    Informasi terbaru sertifikasi akan tampil di halaman ini.
                </p>


            </div>





        @endforelse





    </div>



</section>





@endsection