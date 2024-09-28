@extends('layouts.app')

@section('content')

<!-- Main content -->
<section class="content pt-4">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title">Booking Data</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="data-table" class="table table-bordered table-hover table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Lengkap</th>
                                        <th>Alamat Lengkap</th>
                                        <th>Nomor HP/WhatsApp</th>
                                        <th>Mobil</th>
                                        <th>Tanggal Awal</th>
                                        <th>Tanggal Akhir</th>
                                        <th>Durasi Sewa (Hari)</th>
                                        <th>Jumlah</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $grandTotal = 0; // Inisialisasi grand total
                                    @endphp
                                    @forelse($bookings as $booking)
                                        @php
                                            $grandTotal += $booking->jumlah; // Tambahkan jumlah ke grand total
                                        @endphp
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $booking->nama_lengkap }}</td>
                                            <td>{{ $booking->alamat_lengkap }}</td>
                                            <td>
                                                @if($booking->nomer_wa)
                                                    <a href="tel:{{ $booking->nomer_wa }}" class="text-info">
                                                        <i class="fas fa-phone"></i> {{ $booking->nomer_wa }}
                                                    </a>
                                                @else
                                                    <span class="text-muted">Tidak tersedia</span>
                                                @endif
                                            </td>
                                            
                                            <td>{{ $booking->car->nama_mobil }}</td>
                                            <td>{{ $booking->tanggal_awal }}</td>
                                            <td>{{ $booking->tanggal_akhir }}</td>
                                            <td>
                                                <!-- Menampilkan durasi dengan data-atribut untuk JavaScript -->
                                                @php
                                                    $start = \Carbon\Carbon::parse($booking->tanggal_awal);
                                                    $end = \Carbon\Carbon::parse($booking->tanggal_akhir);
                                                @endphp
                                                <span class="durasi" data-start="{{ $start }}" data-end="{{ $end }}">
                                                    {{ $start->diffInDays($end) }} hari
                                                </span>
                                            </td>              
                                            <td>
                                                <strong>Rp{{ number_format($booking->jumlah, 0, ',', '.') }}</strong>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group btn-group-sm">
                                                    {{-- <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="btn btn-warning">
                                                        <i class="fas fa-edit"></i>
                                                    </a> --}}
                                                    <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST" 
                                                        style="display:inline;" 
                                                        onsubmit="return confirm('Are you sure?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10" class="text-center">Data Kosong!</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                <tfoot class="bg-light">
                                    <tr>
                                        <td colspan="8" class="text-right"><strong>Grand Total:</strong></td>
                                        <td><strong>Rp{{ number_format($grandTotal, 0, ',', '.') }}</strong></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection

@push('style-alt')
  <!-- DataTables -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css">
  <style>
    /* Hover effect for table rows */
    .table-hover tbody tr:hover {
        background-color: #f5f5f5;
    }

    /* Icon style for action buttons */
    .btn-group .btn {
        margin: 0 2px;
    }

    /* Styling for card header */
    .card-header {
        background-color: #007bff;
        color: white;
    }
  </style>
@endpush

@push('script-alt')
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function() {
        $("#data-table").DataTable();

        function updateDurasi() {
            $('.durasi').each(function() {
                let startDate = new Date($(this).data('start'));
                let endDate = new Date($(this).data('end'));
                let now = new Date();

                // Jika sekarang sebelum tanggal awal
                if (now < startDate) {
                    $(this).text("Belum dimulai");
                    return;
                }

                // Jika sekarang setelah tanggal akhir
                if (now > endDate) {
                    $(this).text("Sewa telah berakhir");
                    return;
                }

                // Menghitung durasi waktu tersisa
                let duration = endDate - now; // Durasi sisa dalam milidetik
                let days = Math.floor(duration / (1000 * 60 * 60 * 24));
                let hours = Math.floor((duration % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                let minutes = Math.floor((duration % (1000 * 60 * 60)) / (1000 * 60));
                let seconds = Math.floor((duration % (1000 * 60)) / 1000);

                // Menampilkan durasi
                $(this).text(`${days} hari ${hours} jam ${minutes} menit ${seconds} detik`);
            });
        }

        updateDurasi(); // Update immediately on page load
        setInterval(updateDurasi, 1000); // Update every second
    });

    </script>
@endpush
