<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipper extends Model
{

    use HasFactory;
    protected $fillabe = ['fullname', 'email', 'phonenumber', 'password', 'address', 'identity_number', 'created_at', 'updated_at'];
    protected $primaryKey = 'id';
    protected $table = 'tbl_shipper';


    function order()
    {
        return $this->hasMany('App\Models\Order');
    }
}
