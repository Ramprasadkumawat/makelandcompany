<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ColdStoreTransaction extends Model
{
    protected $table = 'coldstore_transactions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'coldstore_id_FK', 'maal' , 'maal_weight', 'amount', 'payment_type_id_FK', 'datetime', 'type', 'gadi_id_FK', 'merchant_id_FK', 'customer_seller_name',
    ];
}
