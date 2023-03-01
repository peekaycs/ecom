<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['id','user_id','product','category_id','subcategory_id','slug','sku','price','discount','quantity','published','short_description','image','featured','status','order'];
    public $primaryKey = 'id';
}
