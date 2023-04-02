<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttributeGroup extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = ['name'];

    public function attribute()
    {
        return $this->hasMany(Attribute::class);
    }

    public function productAttribute(){
        return $this->hasMany(ProductAttribute::class);
    }
}
