@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{trans('backend.edit_company_settings')}}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a
                                href="{{ route('admin.dashboard') }}">{{trans('backend.home')}}</a></li>
                        <li class="breadcrumb-item active">{{trans('backend.edit_company_settings')}}</li>
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
                        <form method="POST" action="{{ route('company-settings.update',[$data->id]) }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="PUT">
                            <div class="card-body">
                                <div class="form-group {{ $errors->has('company_name') ? ' has-error' : '' }}">
                                    <label>{{trans('backend.company_name')}} *</label>
                                    <input id="company_name" type="text" class="form-control" name="company_name"
                                           value="{{ $data->company_name }}">
                                    @if ($errors->has('company_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('company_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                                    <label>{{trans('backend.description')}}</label>
                                    <textarea id="description" type="text" class="form-control" name="description">{{$data->description}}</textarea>
                                    @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                                    <label>{{trans('backend.address')}} *</label>
                                    <input id="address" type="text" class="form-control" name="address"
                                           value="{{ $data->address }}">
                                    @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label>{{trans('backend.email_address')}} *</label>
                                    <input id="email" type="text" class="form-control" name="email"
                                           value="{{ $data->email }}">
                                    @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('email_send_id') ? ' has-error' : '' }}">
                                    <label>{{trans('backend.email_sender_id')}} *</label>
                                    <input id="email_send_id" type="text" class="form-control" name="email_send_id"
                                           value="{{ $data->email_send_id }}">
                                    @if ($errors->has('email_send_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email_send_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('mobile_number') ? ' has-error' : '' }}">
                                    <label>{{trans('backend.help_line')}} *</label>
                                    <input id="mobile_number" type="text" class="form-control" name="mobile_number"
                                           value="{{ $data->mobile_number }}">
                                    @if ($errors->has('mobile_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mobile_number') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('telephone') ? ' has-error' : '' }}">
                                    <label>{{trans('backend.telephone')}}</label>
                                    <input id="telephone" type="text" class="form-control" name="telephone"
                                           value="{{ $data->telephone }}">
                                    @if ($errors->has('telephone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('telephone') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('fax_number') ? ' has-error' : '' }}">
                                    <label>{{trans('backend.fax_number')}}</label>
                                    <input id="fax_number" type="text" class="form-control" name="fax_number"
                                           value="{{ $data->fax_number }}">
                                    @if ($errors->has('fax_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fax_number') }}</strong>
                                    </span>
                                    @endif
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
