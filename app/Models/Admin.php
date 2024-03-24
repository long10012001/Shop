<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $fillabe = ['admin_email', 'admin_password', 'admin_name', 'admin_phone', 'created_at', 'updated_at'];
    protected $primaryKey = 'id';
    protected $table = 'tbl_admin';

    function receipt()
    {
        return $this->hasMany('App\Models\Receipt');
    }
}
