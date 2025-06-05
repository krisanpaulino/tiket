<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bus extends Model
{
    protected $primaryKey = 'bus_id';
    protected $table = 'bus';
    protected $guarded = ['bus_id'];
    public $timestamps = false;

    function jadwal(): HasMany
    {
        return $this->hasMany(Jadwal::class, 'bus_id', 'bus_id');
    }
}
