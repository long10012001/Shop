<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\FeeShip;
use App\Models\Province;
use App\Models\Wards;
use Dotenv\Store\File\Reader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class FeeShipController extends Controller
{
    //
    public function add_fee_ship()
    {
        $this->is_login();
        $district = District::orderBy('id_district', 'ASC')->get();

        return view('admin.fee_ship.add_fee_ship')
            ->with('district', $district);
    }

    public function select_delivery(Request $request)
    {
        $this->is_login();
        $data = $request->all();

        $wards = Wards::where('id_district', $data['id'])->orderBy('id_wards', 'ASC')->get();
        $output = '';
        $output .= '<option>-- Chọn Xã Phường, Thị Trấn --</option>';
        foreach ($wards as $item) {
            $output .= '<option value="' . $item->id_wards . '">' . $item->name_wards . '</option>';
        }
        echo $output;
    }

    public function save_fee_ship(Request $request)
    {
        $this->is_login();
        $data = $request->all();
        $fee_ship = new FeeShip();
        $fee_ship->id_province = "92";
        $fee_ship->id_district = $data['district'];
        $fee_ship->id_wards = $data['ward'];
        $fee_ship->fee_ship = $data['fee'];
        $fee_ship->save();
        echo '<span>Thêm phí thành công</span>';
    }

    public function load_fee()
    {
        $this->is_login();
        $all_fee = FeeShip::orderBy('id', 'DESC')->get();
        $output = '';
        $output .= '<div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <th>Tên Quận, Huyện</th>
                    <th>Tên Xã Phường, Thị Trấn</th>
                    <th>Phí Ship</th>
                </thead>
                <tbody>';
        foreach ($all_fee as $fee) {
            $output .=  '<tr>
                            <td>' . $fee->district->name_district . '</td>
                            <td>' . $fee->wards->name_wards . '</td>
                            <td  contenteditable data-fee_ship_id="' . $fee->id . '" class="fee_edit" data-value="' . $fee->fee_ship . '">' . number_format($fee->fee_ship, 0, ',', '.') . ' đ</td>
                        </tr>';
        }

        $output .= '</tbody>
            </table>
            </div>
        ';
        echo $output;
    }

    public function update_fee(Request $request)
    {
        $this->is_login();
        $data = $request->all();
        $regex = "/\./"; //to replace multiple dots at the end
        $new_value = rtrim($data['fee_ship'], ' đ');
        $new = preg_replace($regex, '', $new_value);
        $fee_ship = FeeShip::find($data['fee_ship_id']);
        $fee_ship->fee_ship = $new;
        $fee_ship->save();
    }
}
