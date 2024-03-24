<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_receipt extends Model
{
    use HasFactory;
    protected $fillabe = ['receipt_id', 'product_id', 'qty', 'price', 'created_at', 'updated_at'];
    protected $primaryKey = 'id';
    protected $table = 'tbl_detail_receipt';

    function receipt()
    {
        return $this->belongsTo('App\Models\Receipt');
    }

    function product()
    {
        return $this->belongsTo(Product::class);
    }
}