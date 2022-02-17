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
        'id','name', 'stock_name','weigth', 'type','village_id_FK', 'city_id_FK','amount', 'created_at','updated_at'
    ];
}
