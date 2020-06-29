<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    public $table = 'currencies';

    protected $fillable = [
        'name',
        'code',
        'symbol',
        'isDefault',
    ];
}
