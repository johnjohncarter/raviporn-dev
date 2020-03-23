@extends('layout.main')

@section('content')
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">New User</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{ url('manage-user/create') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="username">username<span class="text-red">*</span></label>
                                    <input type="text"
                                           class="form-control @error('username') is-invalid @enderror"
                                           id="username"
                                           name="username"
                                           value="{{ old('username') }}"
                                           placeholder="Enter username">
                                    @error('username')
                                    <span class="text-red" style="font-size: 80%">
                                        Please enter a username
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="name">name<span class="text-red">*</span></label>
                                    <input type="text"
                                           class="form-control @error('name') is-invalid @enderror"
                                           id="name"
                                           name="name"
                                           value="{{ old('name') }}"
                                           placeholder="Enter name">
                                    @error('name')
                                    <span class="text-red" style="font-size: 80%">
                                        Please enter a name
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="surname">surname<span class="text-red">*</span></label>
                                    <input type="text"
                                           class="form-control @error('surname') is-invalid @enderror"
                                           id="surname"
                                           name="surname"
                                           value="{{ old('surname') }}"
                                           placeholder="Enter surname">
                                    @error('surname')
                                    <span class="text-red" style="font-size: 80%">
                                        Please enter a surname
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="password">password<span class="text-red">*</span></label>
                                    <input type="text"
                                           class="form-control @error('password') is-invalid @enderror"
                                           id="password"
                                           name="password"
                                           value="{{ old('password') }}"
                                           placeholder="Enter password">
                                    @error('password')
                                    <span class="text-red" style="font-size: 80%">
                                        Please enter a password
                                    </span>
                                    @enderror
                                    @error('password_math')
                                    <span class="text-red" style="font-size: 80%">
                                        The password and confirm password must math !!
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="confirm_password">confirm_password<span class="text-red">*</span></label>
                                    <input type="text"
                                           class="form-control @error('confirm_password') is-invalid @enderror"
                                           id="confirm_password"
                                           name="confirm_password"
                                           value="{{ old('confirm_password') }}"
                                           placeholder="Enter confirm password">
                                    @error('confirm_password')
                                    <span class="text-red" style="font-size: 80%">
                                        Please enter a confirm password
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="email">email<span class="text-red">*</span></label>
                                    <input type="text"
                                           class="form-control @error('email') is-invalid @enderror"
                                           id="email"
                                           name="email"
                                           value="{{ old('email') }}"
                                           placeholder="Enter email">
                                    @error('email')
                                    <span class="text-red" style="font-size: 80%">
                                        Please enter a email
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="phone">phone</label>
                                    <input type="text"
                                           class="form-control"
                                           id="phone"
                                           name="phone"
                                           value="{{ old('phone') }}"
                                           placeholder="Enter phone">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="facebook">facebook</label>
                                    <input type="text"
                                           class="form-control"
                                           id="facebook"
                                           name="facebook"
                                           value="{{ old('facebook') }}"
                                           placeholder="Enter facebook">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="line">line</label>
                                    <input type="text"
                                           class="form-control"
                                           id="line"
                                           name="line"
                                           value="{{ old('line') }}"
                                           placeholder="Enter line">
                                </div>
                            </div>
                        </div>
                        <div class="row" style="padding-bottom: 50px">
                            <div class="col-sm-12 text-right">
                                <button type="submit" class="btn btn-success">submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
