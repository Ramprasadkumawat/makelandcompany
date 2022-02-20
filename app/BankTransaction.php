<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankTransaction extends Model
{   
    
    protected $table = 'banking_transactions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'laser_id_FK', 'coldstore_transaction_id_FK', 'bank_id_FK', 'document_pic', 'amount', 'status'
    ];
}
