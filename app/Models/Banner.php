<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\BannerImage;

class Banner extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $incrementing = false;
    protected $fillable = ['id', 'name', 'type','description','status'];

    public function bannerImages(){
        return $this->hasMany(BannerImage::class);
    }

    public function getStatusAttribute($value){
        return $value == 0 ? 'Disabled' : 'Enabled';
    }
}
