@extends('frontend.layout')

@section('content')

<div class="site-section bg-light py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h2 class="section-heading text-center mb-4"><strong>Pembayaran Booking</strong></h2>
                <div class="card p-5 shadow-sm">
                    <div class="listing d-block align-items-stretch">
                        <div class="listing-contents h-100">
                            <h3 class="text-center">Booking ID: {{ $booking->id }}</h3>
                            <div class="rent-price text-center mb-3">
                                <strong>Total Pembayaran: Rp{{ number_format($booking->total_price, 0, ',', '.') }}</strong>
                            </div>
                            <div>
                                <p>Silakan lanjutkan pembayaran dengan menekan tombol di bawah.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Tombol Bayar dengan Midtrans -->
                    <button id="pay-button" class="btn btn-primary btn-block btn-lg">Bayar Sekarang</button>
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

@endsection
