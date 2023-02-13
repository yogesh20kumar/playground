@extends('admin.layouts.app')
@section('content')
<style>
  .fs25 {
    font-size: 25px;
    padding: 5px;
    margin-left: 25%;
    cursor: pointer;
  }
  .float-l{
    float: left;
    margin-right: 5px;
  }
  .slots{
    background: #007bff;
    color: #fff;
    padding: 5px;
    margin-right: 5px;
    margin-top: 5px;
  }
</style>
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{trans('backend.manageorder')}} </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a
                                href="{{ route('admin.dashboard') }}">{{trans('backend.home')}}</a></li>
                        <li class="breadcrumb-item active">{{trans('backend.manageorder')}} </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <div class='row mb-2'>
                <div class="col-md-12" id="msgbox">
                    <div class='alert alert-danger d-none' id="msgerrorbox">
                        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                        <span id='msgerror'></span>
                    </div>
                    <div class='alert alert-success d-none' id="msgsuccessbox">
                        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                        <span id='msgsuccess'></span>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<section class="content">
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
        <div class="row">
            <form method="get" action="{{ route('manage-orders.index') }}">
                <div class="card-toolss">
                    <div class="input-group input-group-sm float-left" style="width: 150px;margin-right:7px;">
                        <input type="text" class="form-control float-right" style="width:200px;" name="search" placeholder="Search"
                    value="{{ app('request')->input('search') }}">
                    </div>
                    <div class="input-group input-group-sm float-left" style="width: 150px;margin-right:7px;">
                        <select id="status" name="status" class="form-control float-right">
                            <option value="">Status</option>
                            <option value="1" @if(app('request')->input('status') == 1) selected @endif>Pending</option>
                            <option value="3" @if(app('request')->input('status') == 3) selected @endif>Completed</option>
                            <option value="4" @if(app('request')->input('status') == 4) selected @endif>Cancelled</option>
                        </select>
                    </div>
                    <div class="input-group input-group-sm float-left" style="width: 150px;margin-right:7px;">
                        <input id="date_from" name="date_from" type="date" class="form-control float-right" placeholder="Date From" value="{{ app('request')->input('date_from') }}">
                    </div>

                    <div class="input-group input-group-sm float-left" style="width: 150px;margin-right:7px;">
                        <input id="date_to" name="date_to" type="date" class="form-control float-right" placeholder="Date To" value="{{ app('request')->input('date_to') }}">
                    </div>

                    <div class="input-group-sm float-left" style="margin-right:7px;">
                        <button type="submit" class="form-control btn-default"><i class="fas fa-search"></i></button>
                    </div>
                    <div class="input-group-sm float-left" style="margin-right:7px;">
                        <a href="{{ route('manage-orders.index') }}" class="form-control btn-default"><i class="fas fa-sync-alt"></i></a>
                    </div>
                </div>
            </form>
        </div>
        </div>
        <div class="box-body">
          @if (isset($data) && count($data) > 0)
          <table id="example" class="table table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th>{{trans('backend.order_num')}}</th>
                <th>{{trans('backend.customer')}}</th>
                <th>{{trans('backend.delivery')}}</th>
                <th>Time Slot</th>
                <th>{{trans('backend.order_amount')}}</th>
                <th>{{trans('backend.payment_mode')}}</th>
                <th>{{trans('backend.payment_status')}}</th>
                <th>{{trans('backend.order_status')}}</th>
                <th>{{trans('backend.order_date')}}</th>
                <th>{{trans('backend.action')}}</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $val)
              <tr>
                <td width="3%">{{$val->id}}</td>
                <td width="7%">
                  @if(strtotime(date('Y-m-d')) == strtotime(date('Y-m-d',strtotime($val->created_at))))
                  <sup class="right badge badge-danger">New</sup>
                  @endif
                  {{$val->order_number}}
                </td>
                <td width="7%"><b>{{ $val->name ?? ''}}</b><br>
                  <i style="font-size: 12px;">{{ $val->email ?? ''}}</i>
                  <i style="font-size: 12px;">{{ $val->phone ?? ''}}</i>
                </td>
                <td width="3%">
                <span class="slots" style="margin-bottom:5px;"> {{($val->solts['or_date'] == '0000-00-00')?'N/A':date("d/m/Y", strtotime($val->solts['or_date']))}} </span>
                </td>
                <td width="10%">
                <span class="slots"> {{ date("g:i A", strtotime($val->solts['timesolt'])) }} </span> -
                <span class="slots"> {{ date("g:i A", strtotime($val->solts['to_timesolt'])) }} </span>
                 </td>
                <td width="7%">{{trans('backend.payment_sign')}}
                  {{$val->payment['pay_amount']}}
                </td>
                <td width="8%">{{ $val->payment['payment_method'] }}</td>
                <td width="6%">
                  @if($val->payment['payment_status'] == 1 && $val->payment['payment_method'] == 'Cash Payment')
                  <i class="fas fa-check-circle text-success fs25"  title="Success"></i>
                  @elseif($val->payment['payment_status'] == 1)
                  <i class="fas fa-exclamation-circle text-warning fs25"  title="Pending"></i>
                  @elseif($val->payment['payment_status'] == 2)
                  <i class="fas fa-check-circle fs25 text-success" title="Success"></i>
                  @elseif($val->payment['payment_status'] == 3 || $val->payment['payment_status'] == 4)
                  <i class="far fa-times-circle fs25 text-warning" title="Cancelled"></i>
                  @endif
                </td>
                <td width="6%">
                  @if($val->order_status == 1) <span class="btn btn-sm btn-warning">{{trans('backend.pending')}}</span>
                  @endif
                  @if($val->order_status == 2)<span
                    class="btn btn-sm btn-warning">{{trans('backend.in_progress')}}</span>@endif
                  @if($val->order_status == 3)<span
                    class="btn btn-sm btn-success">{{trans('backend.completed')}}</span>@endif
                  @if($val->order_status == 4)<span
                    class="btn btn-sm btn-danger">{{trans('backend.cancelled')}}</span>@endif
                </td>
                <td width="10%">
                  {{($val->created_at == '0000-00-00 00:00:00')?'N/A':date("d/m/Y, g:i A", strtotime($val->created_at))}}
                </td>
                <td width="8%">
                  <a class="btn btn-success float-l" title="{{trans('backend.view')}}"
                    href="{{ route('manage-orders.show',[$val->id]) }}"><i class="fa fa-eye"></i></a>
                  <a class="btn  btn-primary float-l" title="{{trans('backend.edit')}}"
                    href="{{ route('manage-orders.edit',[$val->id]) }}"><i class="fas fa-pencil-alt"></i></a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          @else
          <br>
          <h5 class="text-center">There is no data found!</h5>
          <br>
          @endif
        </div><!-- /.box-body -->
        <div class="box-footer clearfix" style="text-align: right;">
           {{ $data->appends(['search' => app('request')->input('search'),'status' => app('request')->input('status'), 'date_from' => app('request')->input('date_from'), 'date_to' => app('request')->input('date_to')])->links() }}
        </div>
      </div>
    </div>
  </div>
</div>
</section>
</div>
@endsection
