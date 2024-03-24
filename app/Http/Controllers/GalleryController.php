<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class GalleryController extends Controller
{
    //
    public function add_gallery_product($id)
    {
        $this->is_login();
        $product_id = $id;
        return view('admin.gallery.add_gallery')->with('product_id', $product_id);
    }

    public function load_gallery(Request $request)
    {
        $this->is_login();
        $data = $request->all();
        $gallery = Gallery::where('product_id', $data['product_id'])->get();
        $output = '<table class="table list-table-wp">
        <thead>
            <tr>
                <th scope="col"><span class="thead-text">Tên hình ảnh</span></th>
                <th scope="col"><span class="thead-text">Hình ảnh</span></th>
                <th scope="col"><span class="thead-text">Người tạo</span></th>
                <th scope="col"><span class="thead-text">Ngày tạo</span></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>';
        if ($gallery->count() > 0) {
            foreach ($gallery as $val) {
                $output .= '<tr>
                <td><span class="tbody-text">' . $val->gallery_name . '</span></td>
                <td width="15%">
                    <div class="tbody-thumb">
                        <img src="../public/uploads/gallery/' . $val->gallery_images . '" alt="">
                    </div>
                </td>
                <td><span class="tbody-text">' . $val->admin_create . '</span></td>
                <td> <span class="tbody-text">' . $val->created_at->format('d-m-Y') . '</span></td>
                <td> <a onclick="return confirm(\'Bạn có muốn xoá' . $val->gallery_name . '\')" href="../delete_gallery/' . $val->id . '" class="btn edit delete"> <i class="fa fa-trash" aria-hidden="true"></i> </a></td>
                
            </tr>';
            }
        } else {
            $output .= '<tr>
                <td >Chưa có ảnh</td>
                
            </tr>';
        }
        $output .= ' </tbody>
        </table>';
        echo $output;
    }

    public function insert_gallery(Request $request)
    {
        $this->is_login();
        $product_id = $request->product_id;
        $get_image = $request->file('file');

        if ($get_image) {
            foreach ($get_image as $val) {
                $get_name_image = $val->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image . rand(0, 99) . '.' . $val->getClientOriginalExtension();
                $val->move('public/uploads/gallery', $new_image);
                $gallery = new Gallery();
                $gallery->gallery_name = $new_image;
                $gallery->gallery_images = $new_image;
                $gallery->product_id = $product_id;
                $gallery->admin_create = session('admin_name');
                $gallery->save();
            }
        }
        Session::flash('message', 'Thêm ảnh thành công');
        return redirect()->back();
    }

    public function delete_gallery($id)
    {
        $this->is_login();
        $delete = Gallery::find($id);
        unlink('public/uploads/gallery/' . $delete->gallery_name);
        $delete->delete();
        Session::flash('message', 'Xoá ảnh thành công');
        return redirect()->back();
    }
}
