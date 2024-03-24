<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wards extends Model
{
    use HasFactory;
    protected $fillabe = ['name_wards', 'type', 'id_district'];
    protected $primaryKey = 'id_wards';
    protected $table = 'tbl_wards';
}