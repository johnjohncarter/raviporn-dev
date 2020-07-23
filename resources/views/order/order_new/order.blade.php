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
                    <h3 class="card-title">Order Today</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <a href="{{ url('order-new/create') }}" class="brn btn-info" style="padding: 5px; width: 100%; text-align: center; border-radius: 5px">New Order</a>
                        </div>
                    </div>
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
                                <th>เวลา</th>
                                <th>จำนวน</th>
                                <th>รวมเป็นเงิน(บาท)</th>
                                <th>สถานะการจ่ายเงิน</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if (isset($orders) && count($orders))
                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->customer->name }} {{ $order->customer->surname }}</td>
                                        <td>{{ date('d-m-Y', strtotime($order->order_date)) }}</td>
                                        <td>{{ date('H:i', strtotime($order->order_time)) }}</td>
                                        <td>
                                            @if (isset($order->detail_order))
                                                {{ $order->detail_order->amount }}
                                            @else
                                                {{ $order->total_amount }}
                                            @endif
                                        </td>
                                        <td>
                                            @if (isset($order->detail_order))
                                                {{ number_format($order->detail_order->price, 2) }}
                                            @else
                                                {{ number_format($order->total_price, 2) }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($order->is_pay)
                                                <label style="background-color: #00d900; color: white; padding: 5px;">จ่ายแล้ว</label>
                                            @else
                                                <label style="background-color: #d98b00; color: white; padding: 5px;">ยังไม่ได้จ่าย</label>
                                            @endif
                                        </td>
                                        <td>
                                            @if (!$order->is_pay)
                                                <a href="#" onclick="onConfirmPay({{ $order->id }})"
                                                   class="btn btn-success btn-xs">ยืนยันการจ่ายเงิน</a>
                                                <form id="pay-{{ $order->id }}"
                                                      action="{{ url('order-new/' . $order->id . '/is-pay') }}"
                                                      method="post">
                                                    <input type="hidden" name="_method" value="put">
                                                    @csrf
                                                </form>
                                            @endif
                                            <a href="{{ url('order-new/'.$order['id'] .'/view') }}" class="btn btn-info btn-xs">view</a>
                                            <a href="{{ url('order-new/'.$order['id'] .'/edit') }}" class="btn btn-info btn-xs">edit</a>
                                            <a href="#" onclick="onConfirmDelete({{ $order->id }})" class="btn btn-danger btn-xs">delete</a>
                                            <form id="del-order-{{ $order->id }}"
                                                  action="{{ url('order-new/' . $order->id . '/delete') }}"
                                                  method="post">
                                                <input type="hidden" name="_method" value="delete">
                                                @csrf
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="8">ไม่พบข้อมูล</td>
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

    <script>
        function onConfirmDelete(order_id) {
            let result = confirm('กรุณายืนยันการลบ');
            if (result) {
                document.getElementById('del-order-' + order_id).submit();
            }
        }

        function onConfirmPay(order_id) {
            let result = confirm('กรุณายืนยันการจ่ายเงิน');
            if (result) {
                document.getElementById('pay-' + order_id).submit();
            }
        }
    </script>
@endsection
