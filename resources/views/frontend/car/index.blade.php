@extends('frontend.layout')

@section('content')
<div class="hero inner-page" style="background-image: url('{{ asset('frontend/images/hero_1_a.jpg') }}')">
    <div class="container">
        <div class="row align-items-end">
            <div class="col-lg-5">
                <div class="intro">
                    <h1><strong>Daftar Mobil</strong></h1>
                    <div class="custom-breadcrumbs">
                        <a href="{{ route('homepage') }}">Home</a> <span class="mx-2">/</span>
                        <strong>Daftar Mobil</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="site-section bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <h2 class="section-heading"><strong>Rental Mobil</strong></h2>
                <p class="mb-1">Temukan <b>rental mobil terdekat di kotamu.</b> Harga terbaik untuk kamu yang baik! <br>
                <p  class="mb-1">Mau sewa mobil di manapun dan kapanpun? Rental mobil jadi solusi praktis untuk kebutuhan transportasi kamu. Aberta Rental adalah pilihan yang tepat! Kami menyediakan berbagai jenis mobil, mulai dari mobil keluarga yang nyaman hingga mobil mewah untuk acara spesial. Rental mobil di abertarental.com sangat mudah dan fleksibel, dengan harga yang kompetitif.</p>
                <p class="mb-5">Kami menawarkan harga bersaing dan layanan pelanggan terbaik untuk memastikan pengalaman berkendara yang menyenangkan dan tanpa stres. Cek sekarang untuk menemukan penawaran terbaik dan nikmati perjalanan kamu dengan nyaman!.</p>
            </div><br>
        </div>

        <div class="row">
            @forelse($cars as $car)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="listing d-block align-items-stretch">
                        <div class="listing-img h-100 mr-4">
                            <img src="{{ Storage::url($car->image) }}" alt="Image" class="img-fluid" />
                        </div>
                        <div class="listing-contents h-100">
                            <h3>{{ e($car->nama_mobil) }}</h3> <!-- Menggunakan fungsi e() untuk encoding khusus HTML -->
                            <div class="rent-price">
                                <strong>Rp{{ number_format($car->price, 0, ',', '.') }}</strong><span class="mx-1">/</span>hari
                            </div>
                            <div class="d-block d-md-flex mb-3 border-bottom pb-3">
                                <div class="listing-feature pr-4">
                                    <span class="caption"><i class="fas fa-users"></i> : </span>
                                    <span class="number">{{ $car->penumpang }} seats</span>
                                </div>
                                <div class="listing-feature pr-4">
                                    <span class="caption"><i class="fas fa-car"></i> :</span>
                                    <span class="number">{{ $car->unit }} tersedia</span>
                                </div>
                            </div>
                            <div>
                                <p>{{ e($car->description) }}</p> <!-- Menggunakan fungsi e() untuk keamanan teks deskripsi -->
                                <p>
                                    <a href="{{ route('car.show', $car) }}" class="btn btn-primary btn-sm">Sewa Sekarang</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p class="display-4 text-center mx-auto">Data yang anda cari kosong!</p>
            @endforelse
        </div>
    </div>
</div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection
