<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ColdStoreStocks extends Model
{
    protected $table = 'coldstore_stocks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'coldstore_id_FK', 'name', 'capacity', 'weight', 'status'
    ];
}
