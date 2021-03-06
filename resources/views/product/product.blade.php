@extends('layout.main')

@section('content')
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
                    <h3 class="card-title">Product</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <a href="{{ url('product/create') }}" class="brn btn-info"
                               style="padding: 5px; width: 100%; text-align: center; border-radius: 5px">New Product</a>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ลำดับ</th>
                                <th>ชื่อสินค้า</th>
                                <th>รายละเอียด</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if (isset($products) && count($products))
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->description }}</td>
                                        <td>
                                            <a href="{{ url('product/'.$product['id'].'/edit') }}"
                                               class="btn btn-primary btn-xs">edit</a>
                                            <a href="#" onclick="onConfirmDelete()"
                                               class="btn btn-danger btn-xs">delete</a>
                                            <form id="del-product-{{ $product->id }}"
                                                  action="{{ url('product/' . $product->id . '/delete') }}"
                                                  method="post">
                                                <input type="hidden" name="_method" value="delete">
                                                @csrf
                                            </form>
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
                </div>

            </div>
        </div>
    </div>
    <script>
        function onConfirmDelete() {
            let result = confirm('กรุณายืนยันการลบ');
            if (result) {
                document.getElementById('del-product-{{ $product->id }}').submit();
            }
        }
    </script>
@endsection


