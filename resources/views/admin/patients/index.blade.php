@extends('admin.layouts.app')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{trans('backend.manage_patients')}}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a
                                href="{{ route('admin.dashboard') }}">{{trans('backend.home')}}</a></li>
                        <li class="breadcrumb-item active">{{trans('backend.manage_patients')}}</li>
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
                            <div class="card-tools" style="left:10px;">
                                <form role="search" method="get" action="{{ route('manage.patients') }}">
                                    <div class="card-title">
                                        <div class="input-group input-group-sm float-left" style="width: 250px;">
                                            <input type="text" name="search" placeholder="Search" class="form-control "
                                                value="{{ app('request')->input('search') }}">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-default"><i
                                                        class="fas fa-search"></i></button>
                                                <a href="{{ route('manage.patients') }}" class="btn btn-default"><i
                                                        class="fas fa-sync-alt"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-tools" style="top: 0.3rem;">
                                <div class="input-group input-group-sm">
                                    <a class="btn btn-info pull-right" href="{{ route('patients.create') }}">{{
                                        trans('backend.add_patient') }}</a>
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
                                        <th>{{trans('backend.phone_number')}}</th>
                                        <th>{{trans('backend.address')}}</th>
                                        <th>{{trans('backend.city')}}</th>
                                        <th>{{trans('backend.created_at')}}</th>
                                        <th>{{trans('backend.action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $val)
                                    <tr>
                                        <td width="7%">{{$val->id}}</td>
                                        <td width="20%">{{$val->name}}</td>
                                        <td width="15%">{{$val->email}}</td>
                                        <td width="15%">{{$val->phone}}</td>
                                        <td width="15%">{{$val->address}}</td>
                                        <td width="15%">{{$val->city}}</td>
                                        <td width="15%">{{ date("M j, Y, g:i A",strtotime($val->created_at)) }}</td>
                                        <td width="10%">
                                            <a class="btn btn-primary" title="{{trans('backend.edit')}}"
                                                href="{{ route('patients.edit',[$val->id]) }}"><i class="fas fa-pencil-alt"></i></a>
                                            <!-- <a class="btn btn-danger" title="{{trans('backend.delete')}}"
                                                href="{{ route('patients.edit',[$val->id]) }}"><i class="fas fa-trash"></i></a> -->
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @endif
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            {{ $data->links() }}
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
</div> @endsection
