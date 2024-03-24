@extends('admin.layout.layout')
@section('content')
    <div id="content" class="fl-right">
        <div class="section" id="title-page">
            <div class="clearfix">
                <h3 id="index" class="fl-left">Danh sách bình luận</h3>
            </div>
            <span class="">{{ Session('message') }}</span>


        </div>
        <div class="section" id="detail-page">
            <div class="section-detail">
                <div class="filter-wp clearfix">
                    <ul class="post-status fl-left">
                        <li class="all"><a href="">Tất cả <span class="count">({{ $count }})</span></a>
                        </li>
                    </ul>
                    <form method="get" action="{{ URL::to('search_comment_admin') }}" class="form-s fl-right">

                        <input type="text" name="key" id="search_admin" class="search_admin" placeholder="">
                        <input type="submit" name="sm_s" value="Tìm kiếm" class="search_admin">
                    </form>
                </div>

                <div class="table-responsive">
                    <table class="table list-table-wp">
                        <thead>
                            <tr>
                                <td><span class="thead-text">Khách hàng</span></td>
                                <td><span class="thead-text">Nội dung bình luận</span></td>
                                <td><span class="thead-text">Sản phẩm</span></td>
                                <td><span class="thead-text">Ngày bình luận</span></td>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($list_comment as $comment)
                                <tr>

                                    <td class="clearfix">
                                        <div class="tb-title fl-left">
                                            <a href="" title="">{{ $comment->comment_name }}</a>
                                        </div>
                                        <ul class="list-operation fl-right">

                                            <li><a onclick="return confirm('Bạn có muốn xoá bình luận của {{ $comment->comment_name }}?')"
                                                    href="{{ URL::to('delete_comment') }}/{{ $comment->id }}"
                                                    title="Xóa" class="delete"><i class="fa fa-trash"
                                                        aria-hidden="true"></i></a></li>
                                        </ul>
                                    </td>
                                    <td><span class="tbody-text">{{ $comment->comment_content }}</span></td>
                                    <td><span class="tbody-text">{{ $product[$i]->product_name }}</span></td>


                                    <td><span class="tbody-text">{{ $comment->created_at->format('d-m-Y') }}</span></td>

                                </tr>
                                @php
                                    $i++;
                                @endphp
                            @endforeach


                        </tbody>

                    </table>
                </div>
            </div>
        </div>
        @if (isset($_GET['key']))
            {{ $list_comment->appends(['key' => $_GET['key']])->links('/vendor/pagination/bootstrap-4') }}
        @else
            {{ $list_comment->links('/vendor/pagination/bootstrap-4') }}
        @endif

    </div>
@endsection
