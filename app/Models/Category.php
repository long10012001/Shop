<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillabe = ['category_name', 'category_desc', 'category_status', 'category_by', 'created_at', 'updated_at'];
    protected $primaryKey = 'id';
    protected $table = 'tbl_category_product';
    function product()
    {
        return $this->hasMany('App\Models\Product');
    }
}