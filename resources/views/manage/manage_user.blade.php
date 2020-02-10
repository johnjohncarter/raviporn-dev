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
                    <h3 class="card-title">Manage User</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <a href="{{ url('new-user') }}" class="brn btn-info" style="padding: 5px; width: 100%; text-align: center; border-radius: 5px">New User</a>
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
                                <th>ชื่อผู้ใช้</th>
                                <th>นามสกุล</th>
                                <th>email</th>
                                <th>เบอร์โทรศัพร์</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if (isset($users) && count($users))
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->surname }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>
                                            <a href="{{ url('user-view/'.$user['id']) }}" class="btn btn-info btn-xs">view</a>
                                            <button class="btn btn-primary btn-xs">edit</button>
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
                        {{ $users->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
