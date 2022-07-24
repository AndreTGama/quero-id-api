<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
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
     * Get the type user.
     */
    public function typeUser()
    {
        return $this->belongsTo(TypeUser::class);
    }
}
