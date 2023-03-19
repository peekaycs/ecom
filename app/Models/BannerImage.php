<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerImage extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $fillable = ['id','banner_id','image','title','link'];
}
