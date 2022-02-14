<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    protected $fillable = [
        'name',
        'country_id',
    ];

    /**
     * Define Relationship with Country Model
     *
    */
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    /**
     * Define Relationship with City Model
     *
    */
    public function city()
    {
        return $this->hasMany(City::class, 'id', 'state_id');
    }
}
