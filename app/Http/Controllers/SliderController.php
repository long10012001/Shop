<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


class SliderController extends Controller
{
    //
    public function manager_slider()
    {
        $this->is_login();
        $list_slider = Slider::all();
        $count = $list_slider->count();
        return view('admin.slider.list_slider')
            ->with('list_slider', $list_slider)
            ->with('count', $count);
    }

    public function add_slider()
    {
        $this->is_login();
        return view('admin.slider.add_slider');
    }

    public function save_slider(Request $request)
    {
        $this->is_login();
        $data = $request->all();
        $slider = new Slider();
        $slider->slider_name = $data['slider_name'];
        $slider->slider_status = $data['slider_status'];
        $slider->slider_desc = $data['slider_desc'];
        $slider->slider_by = Session('admin_name');

        $get_image = $request->file('slider_image');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/slider', $new_image);
            $slider->slider_images = $new_image;
            $slider->save();
            Session::flash('message', 'Thêm Slider thành công');
            return Redirect::to('add_slider');
        }
        $slider->slider_images = '';
        $slider->save();
        Session::flash('message', 'Thêm Slider thành công');
        return Redirect::to('add_slider');
    }


    public function active_slider($id_slider)
    {
        $this->is_login();

        $slider = Slider::find($id_slider);
        $slider->slider_status = 0;
        $slider->save();
        Session::flash('message', 'Không kích hoạt slider thành công');
        return Redirect::to('manager_slider');
    }

    public function unactive_slider($id_slider)
    {
        $this->is_login();

        $slider = Slider::find($id_slider);
        $slider->slider_status = 1;
        $slider->save();
        Session::flash('message', 'Kích hoạt slider thành công');
        return Redirect::to('manager_slider');
    }

    public function delete_slider($id)
    {
        $this->is_login();
        $delete = Slider::find($id);
        $delete->delete();
        Session::flash('message', 'Xoá slider thành công');
        return Redirect::to('manager_slider');
    }

    public function update_slider($id)
    {
        $this->is_login();
        $slider = Slider::find($id);
        return view('admin.slider.update_slider')->with('slider', $slider);
    }

    public function save_update_slider(Request $request, $id)
    {
        $this->is_login();
        $data = $request->all();
        $slider = Slider::find($id);
        $slider->slider_name = $data['slider_name'];
        $slider->slider_status = $data['slider_status'];
        $slider->slider_desc = $data['slider_desc'];
        $slider->slider_by = Session('admin_name');

        $get_image = $request->file('slider_image');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/slider', $new_image);
            $slider->slider_images = $new_image;
            $slider->save();
            Session::flash('message', 'Thêm Slider thành công');
            return Redirect::to('manager_slider');
        }
        $slider->save();
        Session::flash('message', 'Cập nhật Slider thành công');
        return Redirect::to('manager_slider');
    }


    public function filter_status_slider(Request $request)
    {
        $this->is_login();
        $status_search = $request->actions;
        if ($status_search == '') {
            $list_slider = Slider::all();
        } else {
            $list_slider = Slider::where('slider_status', $status_search)->get();
        }
        $count = $list_slider->count();
        return view('admin.slider.list_slider')
            ->with('list_slider', $list_slider)
            ->with('count', $count);
    }

    public function search_slider(Request $request)
    {
        $this->is_login();
        $key = $request->key;
        $key_new = htmlspecialchars($key);
        $list_slider = Slider::where('slider_name', 'like', '%' . $key_new . '%')
            ->orWhere('slider_by', 'like', '%' . $key_new . '%')->get();
        $count = $list_slider->count();
        return view('admin.slider.list_slider')
            ->with('list_slider', $list_slider)
            ->with('count', $count);
    }
}
