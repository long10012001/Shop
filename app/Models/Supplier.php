<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $fillabe = ['supplier_name', 'supplier_address', 'supplier_method_payment', 'created_at', 'updated_at'];
    protected $primaryKey = 'id';
    protected $table = 'tbl_supplier';

    function receipt()
    {
        return $this->hasOne('App\Models\Receipt');
    }
}
