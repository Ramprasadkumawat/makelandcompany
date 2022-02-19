<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MazdurTransaction extends Model
{
    protected $table = 'mazdur_transactions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mazdur_id_FK', 'amount', 'type', 'datetime', 
    ];
}
