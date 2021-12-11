<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_Category extends Model
{
    use HasFactory;

    protected $table = 'product__categories';

    protected $fillable = ['product_id', 'category_id'];
}
