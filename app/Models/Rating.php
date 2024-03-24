<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $fillabe = [
        'product_id', 'rating', 'created_at', '	updated_at'
    ];
    protected $primaryKey = 'id';
    protected $table = 'tbl_rating';
}