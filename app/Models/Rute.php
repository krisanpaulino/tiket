<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rute extends Model
{
    protected $primaryKey = 'rute_id';
    protected $table = 'rute';
    protected $guarded = ['rute_id'];
    public $timestamps = false;
}
