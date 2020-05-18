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
                                        <td>{{ $order->order_date }}</td>
                                        <td>{{ $order->total_amount }}</td>
                                        <td>{{ number_format($order->total_price, 2) }}</td>
                                        <td>
                                            @if ($order->is_pay)
                                                <span style="background-color: #00d900; color: white; padding: 5px;">จ่ายแล้ว</span>
                                            @else
                                                <span style="background-color: #d98b00; color: white; padding: 5px;">ค้างจ่าย</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if (!$order->is_pay)
                                                <a href="#" onclick="onConfirmPay({{ $order->id }})"
                                                   class="btn btn-success btn-xs">ยืนยันการจ่ายเงิน</a>
                                                <form id="pay-{{ $order->id }}"
                                                      action="{{ url('order-history/' . $order->id . '/is-pay') }}"
                                                      method="post">
                                                    <input type="hidden" name="_method" value="put">
                                                    @csrf
                                                </form>
                                            @endif
                                            <a href="{{ url('order-history/'.$order['id'].'/view') }}" class="btn btn-info btn-xs">view</a>
                                            <button class="btn btn-danger btn-xs">delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7">ไม่พบข้อมูล</td>
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
        function onConfirmPay(order_id) {
            let result = confirm('กรุณายืนยันการจ่ายเงิน');
            if (result) {
                document.getElementById('pay-' + order_id).submit();
            }
        }
    </script>
@endsection
