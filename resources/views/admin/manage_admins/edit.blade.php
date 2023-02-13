@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{trans('backend.edit_admin')}}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a
                                href="{{ route('admin.dashboard') }}">{{trans('backend.home')}}</a></li>
                        <li class="breadcrumb-item active">{{trans('backend.edit_admin')}}</li>
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
                        <form method="POST" action="{{ route('manage-admin.update',[$data->id]) }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="PUT">
                            <div class="card-body">
                                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label>{{trans('backend.name')}} *</label>
                                    <input id="name" type="text" class="form-control" name="name"
                                           value="{{ $data->name }}" autofocus>
                                    @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label>{{trans('backend.email_address')}} *</label>
                                    <input id="email" type="text" class="form-control" name="email"
                                           value="{{ $data->email }}" autofocus>
                                    @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label>{{trans('backend.password')}}</label>
                                    <input id="password" type="password" class="form-control" name="password" value=""
                                           placeholder="******" autofocus>
                                    @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
                                    <label>{{trans('backend.status')}} *</label>
                                    <select name="status" class="form-control" @if($data->id == 1) disabled @endif>
                                        <option value="1" @if($data->status == 1) selected @endif>Enable</option>
                                        <option value="0" @if($data->status == 0) selected @endif>Disable</option>
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
