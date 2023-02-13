@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Invoice</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('manage-orders.index') }}"> Manage Order </a></li>
            </ol>
          </div>
        </div>
        <div class="callout callout-info">
              <h5><i class="fas fa-info"></i> Suggestion:</h5>
              <i>{{ $data->suggestion ?? ''}}</i>
        </div>
        <div class="callout callout-info">
              <h5>Special Instructions:</h5>
              <i>{{ $data->instructions ?? ''}}</i>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                  <img src="{{ asset('public/img/logo.png') }}" alt="{{ config('app.name', 'Laravel') }} Logo">
                    <small class="float-right">Date: {{ date("d/m/Y",strtotime($data->created_at)) }}</small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  From
                  <address>
                    <strong>{{ $company[0]->company_name }}</strong><br>
                    {{ $company[0]->address }}<br>
                    Help Line: {{ $company[0]->mobile_number }}<br>
                    Email: {{ $company[0]->email }}
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  To
                  <address>
                    <strong>{{ $data->name ?? ''}}</strong><br>
                    City/Place: {{ $data->city ?? ''}}<br>
                    Address: {{ $data->address ?? ''}}<br>
                    Phone: +{{$data->dial_code}} {{substr_replace(substr_replace($data->phone,'-',3,0),'-',7,0)}}<br>
                    Email: {{ $data->email ?? ''}}
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <!-- <b>Invoice #007612</b><br> -->
                  <br>
                  <b>Order ID:</b> {{ $data->order_number ?? ''}}<br>
                  <b>Order Status:</b>
                  @if($data->order_status == 1)<span class="badge badge-warning">{{trans('backend.pending')}}</span> @endif
                  @if($data->order_status == 3)<span class="badge badge-success"> {{trans('backend.completed')}}</span> @endif
                  @if($data->order_status == 4)<span class="badge badge-danger"> {{trans('backend.cancelled')}}</span> @endif
                  <br>
                  <b>Takeaway:</b> {{($data->solts['or_date'] == '0000-00-00')?'N/A':date("d/m/Y", strtotime($data->solts['or_date']))}}
                  <br>
                  <b>Time Slot: </b> {{ date("g:i A", strtotime($data->solts['timesolt'])) }} - {{ date("g:i A", strtotime($data->solts['to_timesolt'])) }}
                 </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Items</th>
                            <th>Qty</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($data->menus)
                        @foreach($data->menus as $prod)
                        <tr>
                            <td>{{$prod['menu_name']}} </td>
                            <td>{{$prod['qty']}} </td>
                            <td>{{trans('backend.payment_sign')}} {{$prod['offer_price']}} </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  <p class="lead">Payment Methods:</p>
                  <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                    Transaction Id: <b>{{ $data->payment['transaction_id'] ?? 'N/A'}}</b>
                    <br>
                    Payment Method:  <span class="badge badge-info">{{ $data->payment['payment_method'] ?? ''}}</span>
                    <br>
                    @if( $data->payment['payment_status'] == 1)
                    Payment Status: <span class="badge badge-warning">Pending</span>
                    @elseif($data->payment['payment_status'] == 2)
                    Payment Status: <span class="badge badge-success">Success</span>
                    @elseif($data->payment['payment_status'] == 3 || $data->payment['payment_status'] == 4)
                    Payment Status: <span class="badge badge-danger">Cancelled</span>
                    @endif
                </p>
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <p class="lead">Order Payment</p>

                  <div class="table-responsive">
                    <table class="table">
                    <tbody>
                    <tr>
                        <th style="width:50%">Subtotal:</th>
                        <td>{{trans('backend.payment_sign')}}
                            {{ $data->payment['menu_total'] }}</td>
                    </tr>
                    @if($data->payment['tax'] != '0.00' && $data->payment['tax'] != 0)
                    <tr>
                        <th>{{ $data->payment['tax_note'] ?? '' }}</th>
                        <td>{{trans('backend.payment_sign')}}
                            {{ $data->payment['tax'] }}</td>
                    </tr>
                    @endif
                    @if($data->payment['delivery_charges'] != '0.00' && $data->payment['delivery_charges'] != 0)
                    <tr>
                        <th>Delivery Charges</th>
                        <td>{{trans('backend.payment_sign')}}
                            {{ $data->payment['delivery_charges'] }}</td>
                    </tr>
                    @endif
                    @if($data->payment['packaging_charges'] != '0.00' && $data->payment['packaging_charges'] != 0)
                    <tr>
                        <th>Packaging Charges</th>
                        <td>{{trans('backend.payment_sign')}}
                            {{ $data->payment['packaging_charges'] }}</td>
                    </tr>
                    @endif
                    @if($data->payment['coupon_benefits'] != '0.00' && $data->payment['coupon_benefits'] != 0)
                    <tr>
                        <th>{{ $data->payment['coupon'] }}</th>
                        <td>- {{trans('backend.payment_sign')}}
                            {{ $data->payment['coupon_benefits'] }}</td>
                    </tr>
                    @endif
                    <tr style="font-size: 18px;">
                        <th>Total:</th>
                        <td><b>{{trans('backend.payment_sign')}}
                        {{ number_format($data->payment['pay_amount'],2) }}</b></td>
                    </tr>
                </tbody>
                     </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <a href="#" onclick="window.print()" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                  <!-- <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                    Payment
                  </button>
                  <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Generate PDF
                  </button> -->
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
</div>

@endsection
