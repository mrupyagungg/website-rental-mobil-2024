@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Dashboard') }}</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
              
                <!-- data mobil -->
                <div class="col-lg-4 col-md-6 col-12 mb-4">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $totalMobil }}</h3>
                            <p>Data Mobil</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-car"></i>
                        </div>
                        <a href="admin/cars" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <!-- data kontak masuk -->
                <div class="col-lg-4 col-md-6 col-12 mb-4">
                    <div class="small-box bg-warning">
                        <div class="inner">
                          <h3>{{ $totalKontak }}</h3>
                          <p>Kontak Masuk</p>
                        </div>
                        <div class="icon">
                          <i class="fas fa-phone"></i>
                        </div>
                        <a href="admin/contacts" class="small-box-footer">
                          More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                      </div>
                </div>

                <!-- data booking -->
                <div class="col-lg-4 col-md-6 col-12 mb-4">
                    <div class="small-box bg-danger">
                        <div class="inner">
                          <h3>{{ $totalBooking }}</h3>
                          <p>Data Booking</p>
                        </div>
                        <div class="icon">
                          <i class="fas fa-shopping-cart"></i>
                        </div>
                        <a href="admin/bookings" class="small-box-footer">
                          More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                      </div>
                </div>

            </div>
            <!-- /.row -->

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Grafik Jumlah Booking per Mobil</h3>
                    <div class="card-tools">
                        <button id="toggleChart" class="btn btn-tool" title="Hide/Show Grafik">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="bookingChart"></canvas>
                </div>
            </div>
            
        </div><!-- /.container-fluid -->
    </div>

@endsection

@push('script-alt')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var bookingCountPerCar = @json($bookingCountPerCar);
            var carLabels = Object.keys(bookingCountPerCar);  // Nama mobil
            var bookingData = Object.values(bookingCountPerCar);  // Jumlah booking

            // Inisialisasi grafik menggunakan Chart.js
            var ctx = document.getElementById('bookingChart').getContext('2d');
            var bookingChart = new Chart(ctx, {
                type: 'doughnut', // Tipe grafik
                data: {
                    labels: carLabels,
                    datasets: [{
                        label: 'Jumlah Booking per Mobil',
                        data: bookingData,
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.6)',
                            'rgba(255, 99, 132, 0.6)',
                            'rgba(255, 206, 86, 0.6)',
                            'rgba(75, 192, 192, 0.6)',
                            'rgba(153, 102, 255, 0.6)',
                            'rgba(255, 159, 64, 0.6)',
                            'rgba(201, 203, 207, 0.6)',
                        ],
                        borderColor: [
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(201, 203, 207, 1)',
                        ],
                        borderWidth: 1,
                        hoverBackgroundColor: 'rgba(75, 192, 192, 1)',
                        hoverBorderColor: 'rgba(0, 0, 0, 1)'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return tooltipItem.dataset.label + ': ' + tooltipItem.raw;
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Nama Mobil'
                            }
                        },
                        // y: {
                        //     beginAtZero: true,
                        //     title: {
                        //         display: true,
                        //         text: 'Jumlah Booking'
                        //     }
                        // }
                    }
                }
            });

            // Toggle grafik
            document.getElementById('toggleChart').addEventListener('click', function() {
                var chartContainer = document.querySelector('.card-body');
                if (chartContainer.style.display === 'none') {
                    chartContainer.style.display = 'block';
                    this.innerHTML = '<i class="fas fa-eye-slash"></i>'; // Ubah ikon
                } else {
                    chartContainer.style.display = 'none';
                    this.innerHTML = '<i class="fas fa-eye"></i>'; // Ubah ikon
                }
            });
        });
    </script>
@endpush
