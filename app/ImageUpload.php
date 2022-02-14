<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageUpload extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'image_name'
    ];

}
