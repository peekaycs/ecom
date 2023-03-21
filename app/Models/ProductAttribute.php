<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductAttributeImage;

class ProductAttribute extends Model
{
    use HasFactory;
    public $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = ['id','product_id','attribute_group_id','attribute_id','price','discount','order'];


    public function productAttributeImage(){
        return $this->hasMany(ProductAttributeImage::class, 'product_attribute_id','id');
    }

    public function product()  
    {  
        return $this->belongsTo(Product::class);  
    }

    public function attributeGroup()  
    {  
        return $this->belongsTo(AttributeGroup::class);  
    }

    public function attribute()  
    {  
        return $this->belongsTo(Attribute::class);  
    }

}
