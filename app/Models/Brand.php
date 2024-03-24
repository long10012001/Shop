<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $fillabe = ['brand_name', 'brand_desc', 'brand_status', 'brand_by', 'created_at', 'updated_at'];
    protected $primaryKey = 'id';
    protected $table = 'tbl_brand_product';

    function product()
    {
        return $this->hasMany('App\Models\Product');
    }
}