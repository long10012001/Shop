<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistical extends Model
{
    use HasFactory;
    protected $fillabe = ['order_date', 'sales', 'profit', 'qty', 'total_order', 'created_at', 'updated_at'];
    protected $primaryKey = 'id';
    protected $table = 'tbl_statistical';
}