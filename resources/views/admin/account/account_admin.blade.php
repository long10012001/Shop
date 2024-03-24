@extends('admin.layout.layout')
@section('content')
    <div id="content" class="fl-right">
        <div class="section" id="title-page">
            <div class="clearfix">
                <h3 id="index" class="fl-left">Danh sách tài khoản người dùng quản trị</h3>
            </div>
            <span class="text-success" id="success">{{ Session('message') }}</span>
        </div>
        <div class="section" id="detail-page">
            <div class="section-detail">
                <div class="filter-wp clearfix">
                    <ul class="post-status fl-left">
                        <li class="all"><a href="">Tất cả <span class="count">({{ $count }})</span></a>
                        </li>
                    </ul>
                    <form method="get" action="{{ URL::to('search_account_admins') }}" class="form-s fl-right">
                        {{-- @csrf --}}
                        <input type="text" name="key" id="search_admin" class="search_admin" placeholder="">
                        <input type="submit" name="sm_s" value="Tìm kiếm" class="search_admin">
                    </form>
                </div>
                @if (Session::get('message_delete'))
                    <span class="text-danger mr-5">{{ Session::get('message_delete') }}</span>
                @endif
                <div class="table-responsive">
                    <table class="table list-table-wp">
                        <thead>
                            <tr>
                                <td><span class="thead-text">STT</span></td>
                                <td><span class="thead-text">Họ và tên</span></td>
                                <td><span class="thead-text">Vai trò</span></td>
                                <td><span class="thead-text">Email</span></td>
                                <td><span class="thead-text">Số điện thoại</span></td>

                                <td><span class="thead-text">Ngày tạo</span></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list_account_admin as $key => $account)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td class="clearfix">
                                        <div class="tb-title fl-left">
                                            <a href="" title="">{{ $account->admin_name }}</a>
                                        </div>
                                        <ul class="list-operation fl-right">
                                            <li><a onclick="return confirm('Bạn có muốn xoá tài khoản {{ $account->admin_name }}?')"
                                                    href="{{ URL::to('delete_account_admin') }}/{{ $account->id }}"
                                                    title="Xóa" class="delete"><i class="fa fa-trash"
                                                        aria-hidden="true"></i></a></li>
                                        </ul>
                                    </td>
                                    <td><span class="tbody-text">{{ $account->role_admin }}</span></td>
                                    <td><span class="tbody-text">{{ $account->email }}</span></td>
                                    <td><span class="tbody-text">{{ $account->admin_phone }}</span></td>

                                    <td><span class="tbody-text">{{ $account->created_at->format('d-m-Y') }}</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if (isset($_GET['key']))
                    {{ $list_account_admin->appends(['key' => $_GET['key']])->links('/vendor/pagination/bootstrap-4') }}
                @elseif(isset($_GET['actions']))
                    {{ $list_account_admin->appends(['actions' => $_GET['actions']])->links('/vendor/pagination/bootstrap-4') }}
                @else
                    {{ $list_account_admin->links('/vendor/pagination/bootstrap-4') }}
                @endif
            </div>
        </div>
    </div>
@endsection
