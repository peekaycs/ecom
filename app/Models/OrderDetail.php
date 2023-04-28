<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    public $incrementing = false;
    

    protected $fillable = ['id','order_id','product_id','product_attribute_id','price','discount','shipping','quantity','total_price','final_price','comission','featured'];

    public function order(){
        return $this->belongsTo(Order::class,'order_id', 'id');
    }

    public function products(){
        return $this->hasMany(Product::class,'product_id', 'id');
    }
}
