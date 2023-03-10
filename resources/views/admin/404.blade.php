@extends('admin.layouts.app')
@section('content')
<section class="content-header">
    <h1>
        {{trans('backend.dashboard')}}
        <small>{{trans('backend.control_panel')}}</small> 
    </h1>
    <ol class="breadcrumb">         
        <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i>{{trans('backend.dashboard')}}</a></li>
    </ol>
</section>
<section class="content">
    <div class="error-page">
        <h2 class="headline text-yellow"> 404</h2>

        <div class="error-content">
            <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>

            <p>
                We could not find the page you were looking for.
                Meanwhile, you may <a href="{{url('admin/dashboard')}}">return to dashboard</a> or try using the search form.
            </p>

        </div>
        <!-- /.error-content -->
    </div>
    <!-- /.error-page -->
</section>
@endsection
