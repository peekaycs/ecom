<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Product;

class Category extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = array('uuid','category','slug','description','status','order','visibility');

    public function product()  
    {  
        return $this->hasMany(Product::class,'category_id','uuid');  
    } 

    public function subcategory(){
        return $this->hasMany(SubCategory::class, 'category_id','uuid');
    }
  
}
