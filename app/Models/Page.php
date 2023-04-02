<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use HasFactory, SoftDeletes;
    public $incrementing = false;
    protected $fillable = ['id','name','title','slug','meta_keywords','content','published'];

    public function getPublishedAttribute($value){
        return $value == 1 ? 'published' : 'unpublished';
    }
}
