<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laser extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id_FK', 'gadi_id_FK', 'maal', 'maal_weight', 'mazdur_ids', 'amount', 'payment_type_id_FK', 'datetime',
    ];
}
