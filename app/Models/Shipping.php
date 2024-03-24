<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;
    protected $fillabe = ['customer_id', 'shipping_name', 'shipping_email', 'shipping_address', 'shipping_phone', 'shipping_note', 'shipping_status', 'created_at', 'updated_at'];
    protected $primaryKey = 'id';
    protected $table = 'tbl_shipping';
    function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }

    function order()
    {
        return $this->hasOne('App\Models\Order');
    }
}
