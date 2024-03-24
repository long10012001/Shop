<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    protected $fillabe = ['gallery_name', 'gallery_images', 'product_id', 'created_at', 'updated_at'];
    protected $primaryKey = 'id';
    protected $table = 'tbl_gallery';
}