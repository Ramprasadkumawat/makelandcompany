<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gadi extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'capacity', 'capacity_weight', 'status'
    ];
}
