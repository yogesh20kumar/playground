@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{
                        trans('backend.dashboard') }}
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">{{ trans('backend.home') }}</a></li>
                        <li class="breadcrumb-item active">{{ trans('backend.dashboard') }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- <div class="row">
              <div class="col-lg-3 col-6">
                Welcome!
              </div>
            </div> -->
            <!-- Small boxes (Stat box) -->
            <!--  SUPER ADMIN ROLE  -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $bookings ?? 0 }}</h3>
                            <p>{{ trans('backend.total_bookings') }}</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <a href="#" class="small-box-footer">{{
                            trans('backend.more_info') }} <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $patients ?? 0 }}<sup style="font-size: 20px"></sup></h3>
                            <p>{{ trans('backend.total_patients') }}</p>
                        </div>
                        <div class="icon">
                            <i class="far ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer">{{
                            trans('backend.more_info') }} <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $doctors ?? 0 }}</h3>
                            <p>{{ trans('backend.doctors') }}</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer">{{ trans('backend.more_info') }}
                            <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

            </div>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection
