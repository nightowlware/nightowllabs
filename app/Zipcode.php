<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zipcode extends Model
{
    protected $primaryKey = 'zip';
    public $incrementing = false;
    protected $keyType = 'string';
}
