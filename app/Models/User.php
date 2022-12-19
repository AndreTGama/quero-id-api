<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that should show table name.
     *
     * @var array
     */
    protected $table = 'users';
    /**
     * fillable
     *
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'bio',
        'slug',
        'type_user_id',
        'profile_picture',
        'verified_email',
        'profile_public',
        'complete_registration',
        'email_verified_at'
    ];
    /**
     * The attributes that should be visible in arrays.
     *
     * @var array
     */
    protected $visible = [
        'id',
        'name',
        'email',
        'slug',
        'bio',
        'profile_picture',
        'verified_email',
        'profile_public',
        'type_user_id',
        'type_user', // Symbolic column to bring the user type information
    ];
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password'];
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    /**
     * Get the type user.
     */
    public function typeUser()
    {
        return $this->belongsTo(TypeUser::class);
    }
}
