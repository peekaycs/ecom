<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductAttribute;
use App\Models\Brand;
use App\Models\ProductAttributeImage;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ProductImage;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['id','user_id','product','category_id','subcategory_id','slug','sku','price','discount','comission','shipping_cost','quantity','published','short_description','image','featured','status','order','brand_id'];
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

    public function category()  
    {  
        return $this->belongsTo(Category::class,'category_id','uuid');  
    }

    public function Subcategory()  
    {  
        return $this->belongsTo(SubCategory::class,'subcategory_id','uuid');  
    }

    public function productImage(){
        return $this->hasMany(ProductImage::class);
    }

    public function productAttribute(){
        return $this->hasMany(ProductAttribute::class);
    }
    
    public function productDetail(){
        return $this->hasOne(ProductDetail::class);
    }

    public function orderDetails(){
        return $this->hasMany(OrderDetail::class,'product_id', 'id');
    }
}
