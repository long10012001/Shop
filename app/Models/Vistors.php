<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vistors extends Model
{
    use HasFactory;
    protected $fillabe = ['ip_address', 'date_visit', 'access_times', 'created_at', 'updated_at'];
    protected $primaryKey = 'id';
    protected $table = 'tbl_visitors';
}