@extends('admin.layout.layout')
@section('content')
    <div id="content" class="fl-right">
        <div class="section" id="title-page">
            <div class="clearfix">
                <h3 id="index" class="fl-left">Thêm tài khoản</h3>
            </div>
        </div>
        <span class="text-success" id="success">{{ Session('message') }}</span>
        <div class="section" id="detail-page">
            <div class="section-detail">
                <form method="POST" action="{{ URL::to('save_account_by_admin') }}">
                    @csrf
                    <label for="email">Email đăng nhập</label>
                    @error('email')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <input type="email" name="email" id="email">

                    <label for="password">Mật khẩu</label>
                    @error('password')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <input type="password" name="password" id="password">

                    <label for="fullname">Họ và tên</label>
                    @error('fullname')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <input type="text" name="fullname" id="fullname">

                    <label for="phone">Số điện thoại</label>
                    @error('phone')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <input type="text" name="phone" id="phone">

                    <label for="identity_number">Số căng cước</label>
                    @error('identity_number')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <input type="text" name="identity_number" id="identity_number">

                    <label for="address">Địa chỉ</label>
                    @error('address')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <input type="text" name="address" id="address">

                    <label>Vai trò</label>
                    @error('role')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <select name="role">
                        <option value="">--Vai trò--</option>
                        <option value="admin">Nhân viên</option>
                        <option value="shipper">Giao hàng</option>
                    </select>
                    <button type="submit" name="btn-submit" id="btn-submit">Thêm mới</button>
                </form>
            </div>
        </div>
    </div>
@endsection
