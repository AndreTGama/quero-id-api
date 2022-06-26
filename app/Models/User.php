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
        'bio',
        'profile_picture',
        'verified_email',
        'profile_public'
    ];
    /**
     * casts
     *
     * Returns dates with entered formats (d-m-Y H:i)
     *
     * @var array
     */
    protected $casts = [
        'create_at' => 'date:d-m-Y H:i',
        'update_at' => 'date:d-m-Y H:i',
        'deleted_at' => 'date:d-m-Y H:i',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password'];
}
