<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeGroup extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function attribute()
    {
        return $this->hasMany(Attribute::class);
    }

    public function productAttribute(){
        return $this->hasMany(ProductAttribute::class);
    }
}
