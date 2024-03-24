<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    use HasFactory;
    protected $fillabe = ['order_id', 'product_id', 'product_name', 'product_price', 'product_qty', 'created_at', 'updated_at'];
    protected $primaryKey = 'id';
    protected $table = 'tbl_order_detail';

    function product()
    {
        return $this->belongsToMany(Product::class);
    }


    function order()
    {
        return $this->belongsTo('App\Models\Order');
    }
}