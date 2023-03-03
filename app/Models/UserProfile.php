<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = ['id','user_id', 'image'];
}
