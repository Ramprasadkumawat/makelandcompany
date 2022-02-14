<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    protected $fillable = [
        'name',
    ];

    /**
     * Define Relationship with State Model
     *
    */
    public function state()
    {
        return $this->hasMany(State::class, 'country_id', 'id');
    }

    /**
     * Define Relationship with City Model
     *
    */
    public function city()
    {
        return $this->hasMany(City::class, 'country_id', 'id');
    }
}
