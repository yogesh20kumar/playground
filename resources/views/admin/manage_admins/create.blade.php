@extends('admin.layouts.app')
@section('content')
<section class="content-header">
    <h1>
        {{trans('backend.add_admin')}}        
    </h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="panel-body">      
                    @if(session()->has('success'))
                    <div class="alert alert-info">
                        {{ session()->get('success') }}
                    </div>
                    @endif
                    <form class="form-horizontal" method="POST" action="{{ route('manage-admin.store') }}">
                        {{ csrf_field() }}   
                        <div class="box-body">               
                            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                <label>{{trans('backend.name')}} *</label>
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}"  autofocus>
                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                <label>{{trans('backend.email_address')}} *</label>
                                <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}"  autofocus>
                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                <label>{{trans('backend.password')}} *</label>
                                <input id="password" type="password" class="form-control" name="password" value="" placeholder="******"  autofocus>
                                @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                <label>{{trans('backend.confirm_password')}} *</label>
                                <input type="password" name="password_confirmation" placeholder="******" class="form-control">
                            </div>
                            <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
                                <label>{{trans('backend.status')}} *</label>
                                <select name="status" class="form-control">
                                    <option value="1">Enable</option>
                                    <option value="0">Disable</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">{{trans('backend.submit')}}</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection
