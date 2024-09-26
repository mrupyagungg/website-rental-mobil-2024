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
                            <!-- menampilkan total id dari database -->
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
        </div><!-- /.container-fluid -->
    </div>

@endsection
