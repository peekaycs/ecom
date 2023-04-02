<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\UserProfile;
use App\Models\Address;
use Spatie\Permission\Traits\HasRoles;
use App\Models\ModelHasRole;
use App\Models\ModelHasPermission;
use Illuminate\Database\Eloquent\SoftDeletes;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'user_type',
        'uuid',
        'email',
        'mobile',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userProfile(){
        return $this->hasOne(UserProfile::class,'user_id','uuid');
    }

    public function userAddress(){
        return $this->hasMany(Address::class,'user_id','uuid');
    }

    public function getFullNameAttribute(){
        return "{$this->first_name}  {$this->middle_name} {$this->last_name}";
    }

    public function userRoles(){
        return $this->hasMany(ModelHasRole::class,'role_id','model_id');
    }

    public function userPermissions(){
        return $this->hasMany(ModelHasPermission::class,'permission_id','model_id');
    }
}
