@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{trans('backend.restaurant_timing')}}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a
                                href="{{ route('admin.dashboard') }}">{{trans('backend.home')}}</a></li>
                        <li class="breadcrumb-item active">{{trans('backend.restaurant_timing')}}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-9">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <!-- form start -->
                        @if(session()->has('success'))
                        <div class="alert alert-info">
                            {{ session()->get('success') }}
                        </div>
                        @endif
                        @if(session()->has('failure'))
                        <div class="alert alert-danger">
                            {{ session()->get('failure') }}
                        </div>
                        @endif
                        <form id="category-form" class="form-horizontal" method="POST" action="{{ route('restaurant-settings.update') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="PUT">
                            <div class="card-body">
                                <div class="card card-primary card-outline">
                                    <!-- /.card-header -->
                                    <div class="card-body p-0">
                                        <div class="table-responsive mailbox-messages">
                                            <table class="table table-hover table-striped">
                                                <tbody>
                                                    <tr>
                                                        <td width="20%"><strong>{{trans('backend.open')}}</strong></td>
                                                        <td><strong>{{trans('backend.day')}}</strong></td>
                                                        <td><strong>{{trans('backend.open_time')}}</strong></td>
                                                        <td><strong>{{trans('backend.close_time')}}</strong></td>
                                                        <td><strong>{{trans('backend.edit')}}</strong></td>
                                                    </tr>



                                                    @if(isset($times) && count($times) > 0)
                                                    @foreach($times as $time)
                                                    <tr>
                                                        <td>
                                                            <span>
                                                                @if(!$time->close)
                                                                <i class="fas fa-door-open" style="color:#009688"></i>
                                                                @else
                                                                <i class="fas fa-door-closed" style="color:#dc3545"></i>
                                                                @endif
                                                            </span>
                                                        </td>
                                                        <td class="mailbox-name">{{ucfirst($time->day)}}</td>
                                                        <td>{{ date('g:i A', strtotime($time->open_time)) }} </td>
                                                        <td>{{ date('g:i A', strtotime($time->close_time)) }}</td>
                                                        <td>
                                                            <a href="#" class="edit-time" data-id="{{$time->id}}" data-close="{{ucfirst($time->close)}}" data-day="{{ucfirst($time->day)}}" data-otime="{{ date('g:i A', strtotime($time->open_time)) }}" data-ctime="{{ date('g:i A', strtotime($time->close_time)) }}">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    @else
                                                    <tr>
                                                        <td colspan="4" class="text-center">
                                                            {{trans('backend.no_data_found')}}<br><br>
                                                        </td>
                                                    </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                            <!-- /.table -->
                                        </div>
                                        <!-- /.mail-box-messages -->
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- Modal -->
    <div class="modal fade" id="timeEditModel" tabindex="-1" role="dialog" aria-labelledby="timeEditModelLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="timeEditModelLabel">{{trans('backend.edit_time')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group msgalert">
                    </div>
                    <div class="form-group">
                        <h5><span class="day-text">Sunday</span> {{trans('backend.timing')}}</h5>
                    </div>
                    <div class="form-group">
                        <label>{{trans('backend.open_time')}}</label>
                        <div class="input-group date" id="open_timepicker" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input otime"
                                   data-target="#open_timepicker">
                            <div class="input-group-append" data-target="#open_timepicker" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="far fa-clock"></i></div>
                            </div>
                        </div>
                        <!-- /.input group -->
                    </div>
                    <div class="form-group">
                        <label>{{trans('backend.close_time')}}</label>
                        <div class="input-group date" id="close_timepicker" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input ctime"
                                   data-target="#close_timepicker">
                            <div class="input-group-append" data-target="#close_timepicker"
                                 data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="far fa-clock"></i></div>
                            </div>
                        </div>
                        <!-- /.input group -->
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <label class="switch">
                                <input type="checkbox" name="close" class="is-close">
                                <span class="slider">On &nbsp; Off</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="time_id" value="">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" data-link="{{ route('restaurant-settings.update') }}" class="btn btn-primary save-time">Save
                        changes</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#open_timepicker').datetimepicker({
            format: 'LT'
        })
        $('#close_timepicker').datetimepicker({
            format: 'LT'
        })
    });
</script>
@endsection
