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
                    <h3 class="card-title">Order History</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Order</th>
                                <th>วันที่ส่งสินค้า</th>
                                <th>จำนวน</th>
                                <th>รวมเป็นเงิน(บาท)</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if (isset($orders) && count($orders))
                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->customer->name }} {{ $order->customer->surname }}</td>
                                        <td>{{ $order->order_date }}</td>
                                        <td>{{ $order->total_amount }}</td>
                                        <td>{{ number_format($order->total_price, 2) }}</td>
                                        <td>
                                            <a href="{{ url('order-view/'.$order['id']) }}" class="btn btn-info btn-xs">view</a>
                                            <button class="btn btn-danger btn-xs">delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6">ไม่พบข้อมูล</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="text-muted">
                        {{ $orders->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
