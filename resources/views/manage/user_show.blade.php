@extends('layout.main')

@section('content')
    <div class="row">
        <div class="col-md-3">
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle" src="../../dist/img/avatar_person.png"
                             alt="User profile picture">
                    </div>

                    <h3 class="profile-username text-center">{{ $user['name'] }} {{ $user['surname'] }}</h3>

                    <p class="text-muted text-center">Software Engineer</p>

                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Followers</b> <a class="float-right">1,322</a>
                        </li>
                        <li class="list-group-item">
                            <b>Following</b> <a class="float-right">543</a>
                        </li>
                        <li class="list-group-item">
                            <b>Friends</b> <a class="float-right">13,287</a>
                        </li>
                    </ul>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail User</h3>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <strong>ส่วนชื่อ</strong>
                        </div>
                        <div class="col-sm-10">
                            <span>{{ $user['name'] }} {{ $user['surname'] }}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <strong>เบอร์โทร</strong>
                        </div>
                        <div class="col-sm-10">
                            <span>{{ $user['phone'] ? $user['phone']: '-' }}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <strong>Email</strong>
                        </div>
                        <div class="col-sm-10">
                            <span>{{ $user['email'] ? $user['email']: '-' }}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <strong>Line</strong>
                        </div>
                        <div class="col-sm-10">
                            <span>{{ $user['line'] ? $user['line']: '-' }}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <strong>Facebook</strong>
                        </div>
                        <div class="col-sm-10">
                            <span>{{ $user['facebook'] ? $user['facebook']: '-' }}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <strong>บทบาท</strong>
                        </div>
                        <div class="col-sm-10">
                            @if($user['role'])
                                <span>{{ $user['role']['name'] }} : {{ $user['role']['description'] }}</span>
                            @else
                                <span>-</span>
                            @endif

                        </div>
                    </div>
                    @if(count($user['product_price']))
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <strong>รายการการขายของลูกค้า</strong>
                        </div>
                        <div class="col-sm-10">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>ไซต์มันฝรั่ง</th>
                                        <th>ราตา บาท/kg</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($user['product_price'] as $index => $product)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $product['product']['name'] }}</td>
                                            <td>{{ $product['price'] }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endif
                </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
@endsection
