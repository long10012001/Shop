<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;
    protected $fillabe = ['slider_name', 'slider_images', 'slider_status', 'slider_desc', 'slider_by', 'created_at', 'updated_at'];
    protected $primaryKey = 'id';
    protected $table = 'tbl_slider';
}