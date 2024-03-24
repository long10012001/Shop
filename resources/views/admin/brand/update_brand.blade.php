@extends('admin.layout.layout')
@section('content')
            <div id="content" class="fl-right">
                <div class="section" id="title-page">
                    <div class="clearfix">
                        <h3 id="index" class="fl-left">Cập nhật danh mục sản phẩm</h3>
                    </div>
                </div>
                <span class="text-success" id="success">{{ Session('message') }}</span>
                <div class="section" id="detail-page">
                    <div class="section-detail">
                        <form method="POST" action="{{URL::to('save_update_brand_product')}}/{{$edit_brand_product->id}}">
                            @csrf
                            <label for="title">Tên danh mục</label>
                            <input type="text" name="title_brand" id="title"
                                value="{{ $edit_brand_product->brand_name }}">
                            {{-- <label for="title">Slug ( Friendly_url )</label> --}}
                            {{-- <input type="text" name="slug" id="slug"> --}}
                            <label for="desc">Mô tả</label>
                            <textarea name="desc_brand" id="desc" class="ckeditor">{{ $edit_brand_product->brand_desc }}</textarea>
                            
                            <button type="submit" name="btn-submit" id="btn-submit">Cập nhật</button>
                        </form>
                    </div>
                </div>
            </div>
       
@endsection
