<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $fillable = ['uuid','user_id','address','landmark','district','city','state','country','zip','name','contact','email','address_type','default_address'];
}
