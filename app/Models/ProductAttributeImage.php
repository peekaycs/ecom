<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttributeImage extends Model
{
    use HasFactory;

    protected $fillable = ['uuid', 'product_id', 'product_attribute_id','image'];
}
