<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    protected $fillable = [
        'amount_uploading',
        'min_critique_buy',
        'max_critique_buy',
        'eligible_nft_creation',
        'percentage_share_nft',
    ];
}
