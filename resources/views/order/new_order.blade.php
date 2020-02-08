@extends('layout.main')

@section('content')
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Order New Create</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="post">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4>กำหนดรายละเอียดสินค้า</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="order_date">กำหนดวันส่ง</label>
                                    <input type="text" class="form-control" id="order_date" placeholder="กำหนดวันส่ง">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="order_time">กำหนดวันเวลาส่ง</label>
                                    <input type="text" class="form-control" id="order_time" placeholder="กำหนดวันเวลาส่ง">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="description">รายละเอียดเพิ่มเติม</label>
                                    <textarea type="text" class="form-control" id="description" placeholder="รายละเอียดเพิ่มเติม"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <h4>กำหนดสินค้า</h4>
                            </div>
                        </div>
                        @foreach($products as $product)
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="order_date">ชื่อสินค้า : </label>
                                    <span>{{ $product['name'] }}</span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="order_date">ราคา : </label>
                                    <span>18 บาท</span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>จำนวนที่สั่ง</label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="จำนวนที่สั่ง">
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </form>
            </div>
        </div>
    </div>
@endsection
