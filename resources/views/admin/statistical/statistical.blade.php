@extends('admin.layout.layout')
@section('content')
    <div id="content" class="fl-right">
        <div class="section" id="title-page">
            <div class="clearfix">
                <h3 id="index" class="fl-left">Thồng kê doanh số bán hàng</h3>
            </div>
        </div>
        <div class="section" id="detail-page">
            <div class="section-detail">
                <div class="filter-wp clearfix">
                    <form autocomplete="off">
                        @csrf
                        <label class="title" for="from">Từ ngày</label>
                        <input type="text" name="title_category" class="mr-3" id="from">
                        <label class="title" for="to">Đến ngày</label>
                        <input type="text" name="slug" class="mr-3" id="to">

                        <button type="button" class="d-inline-block" name="btn-submit" id="btn-submit">Thực hiện</button>
                        <label class="title ml-3" for="filter_statistic">Lọc theo</label>
                        <select name="actions" class="filter_statistic" id="filter_statistic">
                            <option value="">-- Thống kê theo --</option>
                            <option value="7day">7 ngày qua</option>
                            <option value="thismonth">Tháng này</option>
                            <option value="lastmonth">Tháng trước</option>
                            <option value="1year">365 ngày qua</option>
                        </select>
                    </form>
                    {{-- <div class="col-12"> --}}
                    <div id="myfirstchart" style="height: 250px;"></div>
                    <div id="mysecondchart" style="height: 250px;"></div>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
        <div class="section" id="title-page">
            <div class="clearfix">
                <h3 id="index" class="fl-left">Thồng kê tổng doanh thu </h3>
            </div>
        </div>
        <div class="section" id="detail-page">
            <div class="section-detail">
                <div class="filter-wp clearfix">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Chi phí nhập sản phẩm</th>
                                <th scope="col">Tổng lợi nhuận bán ra</th>
                                <th scope="col">Tổng lợi nhuận sau khi trừ đi chi phí</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ number_format($total_receipt) }}đ</td>
                                <td>{{ number_format($total_selling) }}đ</td>
                                <td>{{ number_format($total_profit) }}đ</td>

                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="section" id="title-page">
            <div class="clearfix">
                <h3 id="index" class="fl-left">Thồng kê số lượng truy cập</h3>
            </div>
        </div>
        <div class="section" id="detail-page">
            <div class="section-detail">
                <div class="filter-wp clearfix">
                    <table class="table table-bordered">
                        <thead>
                            <tr>

                                <th scope="col">Số lượt truy cập trong 1 tháng qua</th>
                                <th scope="col">Số lượt truy cập trong tháng này</th>
                                <th scope="col">Số lượt truy cập trong vòng 1 năm</th>
                                <th scope="col">Tống số lượt truy cập</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $total_last_month }}</td>
                                <td>{{ $total_this_month }}</td>
                                <td>{{ $total_last_year }}</td>
                                <td>{{ $count_all }}</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>



    </div>
@endsection
