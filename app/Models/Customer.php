<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillabe = ['customer_name', 'customer_email', 'customer_password', 'customer_phone', 'customer_address', 'created_at', 'updated_at'];
    protected $primaryKey = 'id';
    protected $table = 'tbl_customer';
    function shipping()
    {
        return $this->hasMany('App\Models\Shipping');
    }

    function order()
    {
        return $this->hasMany('App\Models\Order');
    }
}
