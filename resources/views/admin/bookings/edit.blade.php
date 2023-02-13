@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{trans('backend.edit_order_status')}}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a
                                href="{{ route('admin.dashboard') }}">{{trans('backend.home')}}</a></li>
                        <li class="breadcrumb-item active">{{trans('backend.edit_order_status')}}</li>
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
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <!-- form start -->
                        @if(session()->has('success'))
                        <div class="alert alert-info">
                            {{ session()->get('success') }}
                        </div>
                        @endif
                        <form method="POST" action="{{ route('manage-orders.update',[$data->id]) }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="PUT">
                            <div class="card-body">
                                <div class="form-group {{ $errors->has('offer') ? ' has-error' : '' }}">
                                    <label>{{trans('backend.order_number')}}</label>
                                    <input id="offer" type="text" class="form-control"
                                           value="{{ $data->order_number }}" readonly>
                                    @if ($errors->has('offer'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('offer') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <!-- <div class="form-group {{ $errors->has('note') ? ' has-error' : '' }}">
                                    <label>{{trans('backend.note')}}</label>
                                    <input id="note" type="text" class="form-control"
                                           value="{{ $data->note }}">
                                    @if ($errors->has('note'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('note') }}</strong>
                                    </span>
                                    @endif
                                </div> -->

                                <div class="form-group {{ $errors->has('order_status') ? ' has-error' : '' }}">
                                    <label>{{trans('backend.order_status')}} *</label>
                                    <select id="status" name="order_status" class="form-control">
                                        <option value="">Status</option>
                                        <option value="1" @if($data->order_status == 1) selected @endif>Pending</option>
                                        <option value="3" @if($data->order_status == 3) selected @endif>Completed</option>
                                        <option value="4" @if($data->order_status == 4) selected @endif>Cancelled</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-danger" type="submit">{{trans('backend.submit')}}</button>
                                </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
</div>
@endsection
