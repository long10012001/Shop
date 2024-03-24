<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillabe = ['comment_content', 'comment_name', 'comment_product_id', 'created_at', 'updated_at'];
    protected $primaryKey = 'id';
    protected $table = 'tbl_comment';

    function product()
    {
        return $this->hasMany('App\Models\Product');
    }
}
