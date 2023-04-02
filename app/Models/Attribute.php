<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AttributeGroup;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attribute extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['group_id', 'name','status'];
    

    /*public function attributeGroup(){
        return $this->hasMany(AttributeGroup::class, 'id','group_id');
    }*/

    public function attributeGroup()
    {
        return $this->belongsTo(AttributeGroup::class,'group_id','id');
    }

    public function productAttribute()
    {
        return $this->hasMany(ProductAttribute::class);
    }
}
