<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeShip extends Model
{
    use HasFactory;
    protected $fillabe = ['id_district', 'id_wards', 'fee_ship', 'created_at', 'updated_at'];
    protected $primaryKey = 'id';
    protected $table = 'tbl_fee_ship';

    function district()
    {
        return $this->belongsTo('App\Models\District', 'id_district');
    }

    public function wards()
    {
        return $this->belongsTo('App\Models\Wards', 'id_wards');
    }
}