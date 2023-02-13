@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{trans('backend.company_settings')}} </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{trans('backend.home')}}</a></li>
                        <li class="breadcrumb-item active">{{trans('backend.company_settings')}} </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">&nbsp;</h3>
                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            @if (isset($data) && count($data) > 0)
                            <table id="example" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{trans('backend.company_name')}}</th>
                                        <th>{{trans('backend.email_address')}}</th>
                                        <th>{{trans('backend.help_line')}}</th>
                                        <th>{{trans('backend.telephone')}}</th>
                                        <th>{{trans('backend.fax_number')}}</th>
                                        <th>{{trans('backend.action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $val)
                                    <tr>
                                        <td width="5%">{{$val->id}}</td>
                                        <td width="15%">{{$val->company_name}}</td>
                                        <td width="20%">{{$val->email}}</td>
                                        <td width="15%">{{$val->mobile_number}}</td>
                                        <td width="15%">{{$val->telephone}}</td>
                                        <td width="15%">{{$val->fax_number}}</td>
                                        <td width="10%">
                                            <a class="btn btn-danger" title="{{trans('backend.edit')}}"
                                               href="{{ route('company-settings.edit',[$val->id]) }}">{{ trans('backend.edit') }}</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @endif
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
</div>
@endsection