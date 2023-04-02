<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\DateFactoryInterface;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'id';
    public $incrementing = false;

    protected $fillable = ['id', 'name','code','amount','quantity','discount_type','description','couponable_type','couponable_id','start_date','end_date','status'];

    public function getStartDateAttribute($value){
        return date('Y-m-d',strtotime($value));
    }
    public function getEndDateAttribute($value){
        return date('Y-m-d',strtotime($value));
    }
}
