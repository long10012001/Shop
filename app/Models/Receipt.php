<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;
    protected $fillabe = [
        'admin_id', 'supplier_id', 'total_receipt', 'status_receipt', 'created_at', 'updated_at'
    ];
    protected $primaryKey = 'id';
    protected $table = 'tbl_receipt';

    function detail_receipt()
    {
        return $this->hasOne('App\Models\Detail_receipt');
    }

    function supplier()
    {
        return $this->belongsTo('App\Models\Supplier');
    }

    function admin()
    {
        return $this->belongsTo('App\Models\Admin');
    }
}
