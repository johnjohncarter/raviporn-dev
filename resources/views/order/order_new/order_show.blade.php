@extends('layout.main')

@section('content')
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-md-12">
            @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
            @if(session()->has('errors'))
                <div class="alert alert-error">
                    {{ session()->get('errors') }}
                </div>
            @endif
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">รายละเอียด Order</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3"><label>ชื่อลูกค้า</label></div>
                        <div class="col-sm-9">{{ $order->customer->name }} {{ $order->customer->surname }}</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3"><label>วันทีส่งสินค้า</label></div>
                        <div class="col-sm-9">{{ date('d-m-Y', strtotime($order->order_date)) }}</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3"><label>เวลาทีส่งสินค้า</label></div>
                        <div class="col-sm-9">{{ date('H:i', strtotime($order->order_time)) }} น.</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3"><label>รายละเอียดเพิ่มเติม</label></div>
                        <div class="col-sm-9">{{ $order->description }}</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3"><label>สถานะ</label></div>
                        <div class="col-sm-9">
                            @if ($order->is_pay)
                                <label style="background-color: #00d900; color: white; padding: 5px;">จ่ายแล้ว</label>
                            @else
                                <label style="background-color: #d98b00; color: white; padding: 5px;">ยังไม่ได้จ่าย</label>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th class="text-center">ลำดับ</th>
                                        <th class="text-center">ชื่อสินค้า</th>
                                        <th class="text-center">ราคา</th>
                                        <th class="text-center">จำนวน</th>
                                        <th class="text-center">รวมเป็นเงิน(บาท)</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if (isset($order['detail']) && count($order['detail']))
                                        @foreach($order['detail'] as $detail)
                                            <tr>
                                                <td>{{ $detail->id }}</td>
                                                <td>{{ $detail->product->name }}</td>
                                                <td class="text-right">{{ $detail->product_price }}</td>
                                                <td class="text-right">{{ $detail->amount }}</td>
                                                <td class="text-right">{{ number_format($detail->price, 2) }}</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="3"><strong>รวม</strong></td>
                                            <td  class="text-right">
                                                <strong>{{ $order->total_amount }}</strong>
                                            </td>
                                            <td  class="text-right">
                                                <strong>{{ number_format($order->total_price, 2) }}</strong>
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td colspan="5">ไม่พบข้อมูล</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
