<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    protected $fillabe = ['name_district', 'type', 'id_province'];
    protected $primaryKey = 'id_district';
    protected $table = 'tbl_district';

    // public function feeship()
    // {
    //     return $this->hasMany('App\Models\FeeShip');
    // }
}