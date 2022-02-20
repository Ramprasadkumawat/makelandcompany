<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockTransaction extends Model
{
    protected $table = 'stocks_transactions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'stock_id_FK', 'Item_name', 'maal', 'maal_weight', 'type'
    ];
}
