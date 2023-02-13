@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{trans('backend.add_patient')}}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a
                                href="{{ route('admin.dashboard') }}">{{trans('backend.home')}}</a></li>
                        <li class="breadcrumb-item active">{{trans('backend.add_patient')}}</li>
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
                <div class="col-md-4">
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
                        <form id="category-form" class="form-horizontal" method="POST"
                              action="{{ route('patients.store') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="card-body">
                                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label>{{trans('backend.name')}} *</label>
                                    <input id="name" type="text" class="form-control" name="name"
                                           value="{{ old('name') }}" data-validation="required"
                                           data-validation-error-msg="Branch name is required.">
                                    @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label>{{trans('backend.email')}} *</label>
                                    <input id="email" type="text" class="form-control" name="email"
                                           value="{{ old('email') }}" data-validation="required"
                                           data-validation-error-msg="Branch name is required.">
                                    @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                                    <label>{{trans('backend.phone_number')}} *</label>
                                    <input id="phone" type="text" class="form-control" name="phone"
                                           value="{{ old('phone') }}" data-validation="required"
                                           data-validation-error-msg="Phone is required.">
                                    @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                                    <label>{{trans('backend.address')}}</label>
                                    <textarea class="form-control" name="address">{{ old('address') }}</textarea>
                                    @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('state') ? ' has-error' : '' }}">
                                    <label>{{trans('backend.state')}}</label>
                                    <input id="branch_name" type="text" class="form-control" name="state"
                                           value="{{ old('state') }}">
                                    @if ($errors->has('state'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('city') ? ' has-error' : '' }}">
                                    <label>{{trans('backend.city')}}</label>
                                    <input id="branch_name" type="text" class="form-control" name="city"
                                           value="{{ old('city') }}">
                                    @if ($errors->has('city'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('zip_code') ? ' has-error' : '' }}">
                                    <label>{{trans('backend.zip_code')}} </label>
                                    <input id="branch_name" type="text" class="form-control" name="zip_code"
                                           value="{{ old('zip_code') }}">
                                    @if ($errors->has('zip_code'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('zip_code') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <!-- <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
                                    <label>{{trans('backend.status')}} *</label>
                                    <select name="status" class="form-control" data-validation="required">
                                        <option value="1">Active</option>
                                        <option value="2">Close</option>
                                        <option value="3">Suspend</option>
                                    </select>
                                </div> -->
                                <div class="form-group">
                                    <button class="btn btn-danger submitdata"
                                            type="submit">{{trans('backend.submit')}}</button>
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
<script>
    $(document).ready(function () {
        $(".submitdata").on('click', function () {
            $(this).prop('disabled', true);
            $('#category-form').submit();
        });
    });
</script>
@endsection
