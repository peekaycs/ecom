<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'brand', 'description','status','order'];
    public $incrementing = false;

    public function product(){
        return $this->hasMany(Product::class);
    }
}
