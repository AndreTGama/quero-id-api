<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Places extends Model
{
    use HasFactory, SoftDeletes;
    /**
     * The attributes that should show table name.
     *
     * @var array
     */
    protected $table = 'places';
    /**
     * fillable
     *
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'city',
        'state',
        'country',
        'continent',
        'latitude',
        'longitude',
        'currecy',
        'monetary_unit',
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
}
