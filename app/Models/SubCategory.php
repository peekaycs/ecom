<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Product;
use App\Models\Category;

class SubCategory extends Model
{
    use HasFactory;

    protected $table = 'subcategories';

    public $primaryKey = 'uuid';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = array('uuid','category_id', 'subcategory','slug','description','status','order','visibility');

    public function category(){
        return $this->hasMany(Category::class, 'uuid','category_id');
    }

    public function product()  
    {  
        return $this->hasMany(Product::class,'subcategory_id','uuid');  
    }
}
