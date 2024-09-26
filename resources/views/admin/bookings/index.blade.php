@extends('layouts.app')

@section('content')

<!-- Main content -->
<section class="content pt-4">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Booking Data</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="data-table" class="table table-bordered table-striped">
                                <thead>
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
                                        <th>Action</th>
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
                                                <a href="tel:{{ $booking->nomer_wa }}">{{ $booking->nomer_wa }}</a>
                                            </td>
                                            <td>{{ $booking->car->nama_mobil }}</td>
                                            <td>{{ $booking->tanggal_awal }}</td>
                                            <td>{{ $booking->tanggal_akhir }}</td>
                                            <td>
                                                <span class="durasi" 
                                                data-start="{{ $booking->tanggal_awal }} T00:00:00" 
                                                data-end="{{ $booking->tanggal_akhir }} T23:59:59">
                                                {{ $booking->durasi }}
                                                </span>
                                            </td>
                                            <td>
                                                <strong>Rp{{ number_format($booking->jumlah, 0, ',', '.') }}</strong>
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <form onclick="return confirm('Are you sure?')" action="{{ route('admin.bookings.destroy', $booking) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-danger" type="submit"><i class="fa fa-trash"></i></button>
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
                                <tfoot>
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
