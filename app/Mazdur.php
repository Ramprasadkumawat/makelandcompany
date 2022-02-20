<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mazdur extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'per_round_payment', 'status'
    ];
}
