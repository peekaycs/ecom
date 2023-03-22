<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AttributeGroup;

class Attribute extends Model
{
    use HasFactory;

    protected $fillable = ['group_id', 'name','status'];

    /*public function attributeGroup(){
        return $this->hasMany(AttributeGroup::class, 'id','group_id');
    }*/

    public function attributeGroup()
    {
        return $this->belongsTo(AttributeGroup::class);
    }

    public function productAttribute()
    {
        return $this->hasMany(ProductAttribute::class);
    }
}
