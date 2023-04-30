<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Payment;
use App\Models\OrderDetail;
class Order extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    public $incrementing = false;
    

    protected $fillable = ['id','user_id','order_code','total','discount','applied_coupon','shipping','coupon_code','coupon_amount','coupon_amount_percent','payable_amount','cart_count'];


    public function user(){
        return $this->belongsTo(User::class,'user_id', 'uuid');
    }

    public function payment(){
        return $this->hasOne(Payment::class,'order_id', 'id');
    }

    public function orderDetails(){
        return $this->hasMany(OrderDetail::class,'order_id', 'id');
    }
}
