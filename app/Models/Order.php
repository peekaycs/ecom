<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    public $incrementing = false;
    

    protected $fillable = ['id','user_id','total','discount','applied_coupon','shipping','coupon_code','coupon_amount','coupon_amount_percent','payable_amount','cart_count'];
}
