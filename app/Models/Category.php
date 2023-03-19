<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Product;

class Category extends Model
{
    use HasFactory;

    protected $fillable = array('uuid','category','slug','description','status','order','visibility');

    public function product()  
    {  
        return $this->hasMany(Product::class,'category_id','uuid');  
    } 
  
}
