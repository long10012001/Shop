@extends('admin.layout.layout')
@section('content')
    <div id="content" class="fl-right">
        <div class="section" id="title-page">
            <div class="clearfix">
                <h3 id="index" class="fl-left">Thêm mới phí vận chuyển</h3>
            </div>
        </div>
        <span class="text-success" id="success">{{ Session('message') }}</span>
        <div class="section" id="detail-page">
            <div class="section-detail">
                <form method="POST">
                    @csrf
                    <label for="title">Quận, Huyện</label>
                    <select name="district" id="district" class="choose district">
                        <option value="">-- Chọn Quận, Huyện --</option>
                        @foreach ($district as $item)
                            <option value="{{ $item->id_district }}">{{ $item->name_district }}</option>
                        @endforeach
                    </select>
                    <label for="title">Xã Phường, Thị Trấn</label>
                    <select name="wards" id="wards" class="wards">
                        <option value="">-- Chọn Xã Phường, Thị Trấn --</option>
                    </select>
                    <label for="title">Phí vận chuyển</label>
                    <input type="text" name="fee_ship" id="fee_ship" class="fee_ship">

                    <button type="button" name="btn-submit" class="add_fee" id="btn-submit">Thêm phí vận chuyển</button>
                </form>
            </div>
        </div>
        <div id="load_fee">

        </div>
    </div>
@endsection
