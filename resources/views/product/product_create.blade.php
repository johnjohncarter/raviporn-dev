@extends('layout.main')

@section('content')
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">New Product</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{ url('product/create') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="name">ชื่อสินค้า</label>
                                    <input type="text"
                                           class="form-control"
                                           id="name"
                                           name="name"
                                           placeholder="Enter name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="description">รายละเอียดสินค้า</label>
                                    <input type="text"
                                           class="form-control"
                                           id="description"
                                           name="description"
                                           placeholder="Enter description">
                                </div>
                            </div>
                        </div>
                        <div class="row" style="padding-bottom: 50px">
                            <div class="col-sm-6 text-right">
                                <button type="submit" class="btn btn-success">submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
