<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillabe = [
        'category_id', 'brand_id', 'product_name', 'product_qty', 'number_sale',
        'product_desc', 'product_content', 'product_price', 'product_image',
        'product_status', 'product_by', 'created_at', '	updated_at'
    ];
    protected $primaryKey = 'id';
    protected $table = 'tbl_product';
    function brand()
    {
        return $this->belongsTo('App\Models\Brand');
    }

    function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    function order_detail()
    {
        return $this->belongsToMany(Order_detail::class);
    }

    function comment()
    {
        return $this->belongsToMany('App\Models\Comment');
    }

    function detail_receipt()
    {
        return $this->belongsToMany(Detail_receipt::class);
    }
}
