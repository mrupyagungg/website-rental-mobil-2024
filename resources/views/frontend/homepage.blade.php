@extends('frontend.layout')

@section('content')

<div class="hero" style="background-image: url('{{ asset('frontend/images/hero_1_a.jpg') }}'); padding: 50px 0;">
  <div class="container">
    <div class="row align-items-center justify-content-center">
      <div class="col-lg-10">
        <div class="row mb-5">
          <div class="col-lg-7 intro">
            <h1><strong>Sewa Mobil</strong> Dengan Satu Sentuhan.</h1>

          </div>
        </div>
        <form class="trip-form" method="get" action="{{ route('car.index') }}">
          <div class="form-row align-items-center">
            <div class="col-md-4 mb-3">
              <h7 class="mb-2">Pilih Kategori Mobil</h7>
              <label for="id" class="sr-only">Pilih Kategori Mobil</label>
              <select name="id" id="id" class="custom-select form-control">
                <option value="">Pilih Kategori Mobil</option>
                @foreach($cars as $type)
                  <option value="{{ $type->id }}">{{ $type->nama_mobil }}</option>
                @endforeach
              </select>                  
            </div>
            <div class="col-md-4 mb-3">
                              
            </div>
            <div class="col-md-4 mb-0">
              <input type="submit" value="Cari" class="btn btn-primary btn-block py-3">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="site-section">
  <div class="container">
    <h2 class="section-heading"><strong>Cara Pemesanan</strong></h2>
    <p class="mb-5"><h6>Temukan pilihan rental mobil terlengkap dengan harga bersahabat. Layanan profesional untuk kebutuhan mobilmu di seluruh Indonesia. Pesan sekarang!</h6></p>
    <div class="row mb-5">
      <div class="col-lg-4 mb-4 mb-lg-0">
        <div class="step">
          <span>1</span>
          <div class="step-inner">
            <span class="number text-primary">01.</span>
            <h3>Pilih Mobil</h3>
            <p>Kami menyediakan berbagai jenis mobil untuk di sewakan</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 mb-4 mb-lg-0">
        <div class="step">
          <span>2</span>
          <div class="step-inner">
            <span class="number text-primary">02.</span>
            <h3>Isi Form</h3>
            <p>Setelah Memilih, Lalu isi form untuk mengisi data diri anda.</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 mb-4 mb-lg-0">
        <div class="step">
          <span>3</span>
          <div class="step-inner">
            <span class="number text-primary">03.</span>
            <h3>Pembayaran</h3>
            <p>Setelah Mengisi Form yang telah di sediakan.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="site-section">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-7 text-center order-lg-2">
        <div class="img-wrap-1 mb-5">
          <img src="{{ asset('frontend/images/feature_01.png') }}" alt="Feature Image" class="img-fluid" />
        </div>
      </div>
      <div class="col-lg-4 ml-auto order-lg-1">
        <h3 class="mb-4 section-heading"><strong>Kami berkomitmen untuk memberikan pelayanan terbaik</strong></h3>
        <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repudiandae, explicabo iste a labore id est quas, doloremque veritatis! Provident odit pariatur dolorem quisquam, voluptatibus voluptates optio accusamus, vel quasi quidem!</p>
        <p><a href="#" class="btn btn-primary">Kontak Kami</a></p>
      </div>
    </div>
  </div>
</div>

<div class="site-section bg-light">
  <div class="container">
    <div class="row">
      <div class="col-lg-7">
        <h2 class="section-heading"><strong>Daftar Mobil</strong></h2>
        <p class="mb-5">Pilihlah mobil yang ingin anda gunakan .</p>
      </div>
    </div>
    <div class="row">
      @foreach($cars as $car)
        <div class="col-md-6 col-lg-4 mb-4">
          <div class="listing d-block align-items-stretch">
            <div class="listing-img h-100 mr-4">
              <img src="{{ Storage::url($car->image) }}" alt="{{ $car->nama_mobil }}" class="img-fluid" />
            </div>
            <div class="listing-contents h-100">
              <h3>{{ $car->nama_mobil }}</h3>
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
                <div class="rent-price">
                  <small>Price</small><br>
                  <strong>Rp {{ number_format($car->price,0,",",".") }}</strong><span class="mx-1">/</span>hari
                </div>
                <p>{{ $car->description }}</p>
                <p><a href="{{ route('car.show', $car) }}" class="btn btn-primary btn-sm">Sewa Sekarang</a></p>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>

<div class="site-section bg-light">
  <div class="container">
    <div class="row">
      <div class="col-lg-7">
        <h2 class="section-heading"><strong>Testimonial</strong></h2>
        <p class="mb-5">Sekarang giliran anda yang akan menilai kinerja kami !</p>
      </div>
    </div>
    <div class="row">
      @foreach($testimonials as $testimonial)
        <div class="col-lg-4 mb-4 mb-lg-0">
          <div class="testimonial-2">
            <blockquote class="mb-4">
              <p>{{ $testimonial->pesan }}</p>
            </blockquote>
            <div class="d-flex v-card align-items-center">
              <img src="{{ Storage::url($testimonial->profile) }}" alt="Testimonial Image" style="object-fit:cover;width: 80px;height:80px;" class="img-fluid mr-3" />
              <div class="author-name">
                <span class="d-block">{{ $testimonial->name }}</span>
                <span>{{ $testimonial->pekerjaan }}</span>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

@endsection
