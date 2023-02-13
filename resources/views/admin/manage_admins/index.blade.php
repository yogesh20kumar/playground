@extends('admin.layouts.app')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{trans('backend.manage_admin')}}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{trans('backend.home')}}</a></li>
                        <li class="breadcrumb-item active">{{trans('backend.manage_admin')}}</li>
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
                            <table id="example" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{trans('backend.name')}}</th>
                                        <th>{{trans('backend.email_address')}}</th>
                                        <th>{{trans('backend.password')}}</th>
                                        <th>{{trans('backend.role')}}</th>
                                        <th>{{trans('backend.action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $val)
                                    <tr>
                                        <td width="7%">{{$val->id}}</td>
                                        <td width="20%">{{$val->name}}</td>
                                        <td width="25%">{{$val->email}}</td>
                                        <td width="20%">********</td>
                                        <td width="20%">{{ ($val->id == 1)?trans('backend.super_admin'): trans('backend.sub_admin')}}</td>
                                        <td width="10%">
                                            <a class="btn btn-danger" title="{{trans('backend.edit')}}"
                                               href="{{ route('manage-admin.edit',[$val->id]) }}">{{ trans('backend.edit') }}</a>
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
</div> @endsection