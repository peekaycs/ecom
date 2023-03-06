<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductAttribute;
use App\Models\Brand;
use App\Models\ProductAttributeImage;
class Product extends Model
{
    use HasFactory;

    protected $fillable = ['id','user_id','product','category_id','subcategory_id','slug','sku','price','discount','quantity','published','short_description','image','featured','status','order','brand_id'];
    public $primaryKey = 'id';
    public $incrementing = false;

    public function attributes(){
        return $this->hasMany(ProductAttribute::class,'product_id','id');
    }

    public function brand(){
        return $this->hasOne(Brand::class,'id','brand_id');
    }
    // public function productAttributeImage(){
    //     return $this->hasMany(ProductAttributeImage::class, 'product_id');
    // }
    
}
