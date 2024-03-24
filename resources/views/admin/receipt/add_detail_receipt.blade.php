@extends('admin.layout.layout')
@section('content')
    <div id="content" class="fl-right">
        <div class="section" id="title-page">
            <div class="clearfix">
                <h3 id="index" class="fl-left">Danh sách sản phẩm đã có</h3>

            </div>
        </div>
        <div class="section" id="detail-page">
            <div class="section-detail">


                <div class="table-responsive">
                    <form method="POST" action="{{ URL::to('save_detail_receipt') }}">
                        <button type="submit" name="btn-submit" id="btn-submit">Thêm phiếu nhập</button>

                        @csrf
                        <table class="table list-table-wp">
                            <thead>
                                <tr>

                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Mã sản phẩm</span></td>
                                    <td style="width: 15%"><span class="thead-text">Hình ảnh</span></td>

                                    <td><span class="thead-text">Tên sản phẩm</span></td>
                                    <td><span class="thead-text">Giá</span></td>
                                    <td><span class="thead-text">Số lượng</span></td>
                                    <td><span class="thead-text">Danh mục</span></td>

                                    <td><span class="thead-text">Người tạo</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($all_product as $item)
                                    <tr>

                                        <td><span class="tbody-text">{{ $i++ }}</span>
                                        <td><span class="tbody-text">WEB0{{ $item->id }}</span>
                                        <td>
                                            <div class="tbody-thumb">
                                                <img src="public/uploads/product/{{ $item->product_image }}" alt="">
                                            </div>
                                        </td>

                                        <td class="clearfix">
                                            <div class="tb-title fl-left">
                                                <a href="" title="">{{ $item->product_name }}</a>
                                            </div>

                                        </td>
                                        <td><span class="tbody-text"><input type="number"
                                                    name="price_product[{{ $item->id }}][]">đ</span>
                                        </td>
                                        <td><span class="tbody-text"><input type="number" data-id="{{ $item->id }}"
                                                    name="qty_product[{{ $item->id }}][]"></span></td>
                                        <td><span class="tbody-text">{{ $item->category->category_name }}</span></td>

                                        <td><span class="tbody-text">{{ $item->product_by }}</span></td>
                                        <td><span class="tbody-text">{{ $item->brand->created_at->format('d-m-Y') }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>

                            </tfoot>
                        </table>
                    </form>
                </div>
            </div>
        </div>
        {{-- @if (isset($_GET['key']))
            {{ $all_product->appends(['key' => $_GET['key']])->links('/vendor/pagination/bootstrap-4') }}
        @elseif (isset($_GET['category']))
            {{ $all_product->appends(['category' => $_GET['category'], 'status' => $_GET['status']])->links('/vendor/pagination/bootstrap-4') }}
        @else
            {{ $all_product->links('/vendor/pagination/bootstrap-4') }}
        @endif --}}


    </div>
@endsection
