<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coldstore extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "coldstores";

    protected $fillable = [
        'city_id_FK', 'village_id_FK', 'name', 'status'
    ];
}
