<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillabe = ['order_code', 'customer_id', 'shipping_id', 'payment_method', 'order_number', 'order_total', 'order_status', 'created_at', 'updated_at'];
    protected $primaryKey = 'id';
    protected $table = 'tbl_order';
    function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }

    function order_detail()
    {
        return $this->hasOne('App\Models\Order_detail');
    }

    function shipping()
    {
        return $this->belongsTo('App\Models\Shipping');
    }
}