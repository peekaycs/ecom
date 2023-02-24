<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserProfile extends Model
{
    use HasFactory;

    public function profile(){
        return User::find(Auth::user()->id);
    }
}
