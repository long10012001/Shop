<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    protected $fillabe = ['name_province', 'type'];
    protected $primaryKey = 'id_province';
    protected $table = 'tbl_province';
}
