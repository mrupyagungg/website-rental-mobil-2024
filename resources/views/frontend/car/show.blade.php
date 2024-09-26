@extends('frontend.layout')

@section('content')

{{-- show.blade.php --}}

<!-- Link Font Awesome Terbaru -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<div class="hero inner-page" style="background-image: url('{{ asset('frontend/images/hero_1_a.jpg') }}'); height: 400px;">
    <div class="container d-flex justify-content-center align-items-center" style="height: 100%;">
        <h1 class="text-dark">Sewa Mobil dengan Mudah</h1>
    </div>
</div>

<div class="site-section bg-light py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Tampilkan error jika ada -->
                @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <ul class="p-0 m-0" style="list-style: none;">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                
                <!-- Tampilkan pesan jika ada -->
                @if(session()->has('message'))
                <div class="alert alert-{{ session('alert-type', 'info') }} alert-dismissible fade show" role="alert">
                    <strong>{{ session('message') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                <h2 class="section-heading text-center mb-4"><strong>Isi Data Anda</strong></h2>
                <div class="card p-5 shadow-sm">
                    <div class="listing d-block align-items-stretch">
                        <div class="listing-img h-100 mb-4 text-center">
                            <img src="{{ Storage::url($car->image) }}" alt="Image" class="img-fluid" style="max-height: 300px; width: auto; border-radius: 8px;">
                        </div>
                        <div class="listing-contents h-100">
                            <h3 class="text-center">{{ $car->nama_mobil }}</h3>
                            <div class="rent-price text-center mb-3">
                                <strong>Rp{{ number_format($car->price, 0, ',', '.') }}</strong><span class="mx-1">/</span>hari
                            </div>
                            <div class="d-block d-md-flex mb-3 justify-content-around border-bottom pb-3">
                                <div class="listing-feature">
                                    <span class="caption"><i class="fas fa-user-friends icon-spacing"></i> Penumpang:</span>
                                    <span class="number">{{ $car->penumpang }} seats</span>
                                </div>
                                <div class="listing-feature">
                                    <span class="caption"><i class="fas fa-car-side icon-spacing"></i> Unit:</span>
                                    <span class="number">{{ $car->unit }}</span>
                                </div>
                                <div class="listing-feature">
                                    <span class="caption"><i class="fas fa-car-alt icon-spacing"></i> Tipe:</span>
                                    <span class="number">{{ $car->type_id }}</span>
                                </div>
                            </div>
                            <div>
                                <p>{{ $car->description }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Form untuk input data penyewaan -->
                    <form action="{{ route('car.store') }}" method="post" id="rental-form">
                        @csrf
                        <input type="hidden" name="car_id" value="{{ $car->id }}">

                        <div class="form-group">
                            <label for="nama_lengkap">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" class="form-control" id="nama_lengkap" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat_lengkap">Alamat Lengkap</label>
                            <input type="text" name="alamat_lengkap" value="{{ old('alamat_lengkap') }}" class="form-control" id="alamat_lengkap" required>
                        </div>
                        <div class="form-group">
                            <label for="nomer_wa">Nomer Hp/Whatsapp</label>
                            <input type="text" name="nomer_wa" value="{{ old('nomer_wa') }}" class="form-control" id="nomer_wa" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_awal">Pilih Tanggal Awal Sewa</label>
                            <input type="datetime-local" name="tanggal_awal" value="{{ old('tanggal_awal') }}" class="form-control" id="tanggal_awal" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_akhir">Pilih Tanggal Akhir Sewa</label>
                            <input type="datetime-local" name="tanggal_akhir" value="{{ old('tanggal_akhir') }}" class="form-control" id="tanggal_akhir" required>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-block btn-lg">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script validation form -->
@section('scripts')
<script>
document.getElementById('rental-form').addEventListener('submit', function(event) {
    var nama = document.getElementById('nama_lengkap').value;
    var alamat = document.getElementById('alamat_lengkap').value;
    var nomer = document.getElementById('nomer_wa').value;
    var tanggalAwal = new Date(document.getElementById('tanggal_awal').value);
    var tanggalAkhir = new Date(document.getElementById('tanggal_akhir').value);

    if (!nama || !alamat || !nomer || !tanggalAwal || !tanggalAkhir) {
        alert('Semua field harus diisi!');
        event.preventDefault();
    } else if (tanggalAkhir <= tanggalAwal) {
        alert('Tanggal akhir sewa harus lebih dari tanggal awal!');
        event.preventDefault();
    }
});

</script>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection

@endsection
