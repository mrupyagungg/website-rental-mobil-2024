@extends('frontend.layout')

@section('content')

<div class="site-section bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h2 class="section-heading text-center mb-4"><strong>Checkout</strong></h2>
                <div class="card p-5 shadow-sm">
                    <div class="d-flex">
                        <!-- Gambar Mobil -->
                        <div class="me-4">
                            <img src="{{ Storage::url($car->image) }}" alt="Image" class="img-fluid" style="max-height: 300px; width: auto; border-radius: 8px;" onerror="this.onerror=null; this.src='{{ asset('path/to/default/image.jpg') }}';">

                        </div>
                        <!-- Detail Booking -->
                        <div class="listing-contents h-100">
                            <h3 class="mb-3">Booking ID: <span class="text-primary">{{ $booking->id }}</span></h3>
                            <h4 class="mb-3">Nama Mobil: {{ $car->nama_mobil }}</h4>
                            <h4 class="mb-3">Merk Mobil: {{ $car->type_id }}</h4>
                            <h4 class="mb-3">Nama Lengkap: {{ $booking->nama_lengkap }}</h4>
                            <h4 class="mb-3">Alamat: {{ $booking->alamat_lengkap }}</h4>
                            <h4 class="mb-3">Nomor HP / WA: {{ $booking->nomer_wa }}</h4>
                            <div class="rent-price text-center mb-3">
                                <strong>Total Pembayaran: <span class="text-danger">Rp{{ number_format($booking->jumlah, 0, ',', '.') }}</span></strong>
                            </div>
                            <p>Silakan lanjutkan pembayaran untuk mengonfirmasi booking Anda.</p>
                        </div>
                    </div>
                    <!-- Tombol Bayar dengan Midtrans -->
                    <div class="text-center">
                        <button id="pay-button" class="btn btn-primary btn-lg">Bayar Sekarang</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script Midtrans -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
<script type="text/javascript">
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function () {
        snap.pay('{{ $booking->snap_token }}', {
            // Optional: fungsi callback untuk berhasil atau gagal
            onSuccess: function(result) {
                alert("Pembayaran berhasil!");
                window.location.href = "/"; // Ubah ke halaman success jika diperlukan
            },
            onPending: function(result) {
                alert("Menunggu pembayaran!");
            },
            onError: function(result) {
                alert("Pembayaran gagal!");
            },
            onClose: function() {
                alert("Anda menutup popup tanpa menyelesaikan pembayaran.");
            }
        });
    });
</script>

<style>
    /* General Styles */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f8f9fa; /* Light background for the page */
}

.site-section {
    padding: 60px 0; /* More space for the section */
}

/* Checkout Card Styles */
.card {
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    padding: 30px;
}

/* Flexbox for Image and Details */
.d-flex {
    display: flex;
    align-items: center;
}

/* Image Styles */
.img-fluid {
    border-radius: 8px;
}

/* Headings and Text */
h2.section-heading {
    font-size: 2rem;
    margin-bottom: 20px;
}

h3 {
    font-size: 1.5rem;
    margin-bottom: 15px;
}

h4 {
    font-size: 1.25rem;
    margin-bottom: 10px;
}

.text-primary {
    color: #007bff; /* Primary color for text */
}

.text-danger {
    color: #dc3545; /* Danger color for total payment */
}

/* Button Styles */
.btn {
    border-radius: 25px;
    padding: 10px 20px;
    font-size: 1rem;
    transition: background-color 0.3s ease;
}

.btn-primary {
    background-color: #007bff; /* Primary button color */
    border: none;
}

.btn-primary:hover {
    background-color: #0056b3; /* Darker shade on hover */
}

/* Responsive Design */
@media (max-width: 768px) {
    .d-flex {
        flex-direction: column; /* Stack image and details on small screens */
        align-items: center;
    }

    .me-4 {
        margin-right: 0;
        margin-bottom: 20px; /* Add margin for spacing */
    }
}

</style>

@endsection
