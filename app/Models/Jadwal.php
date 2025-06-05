<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Jadwal extends Model
{
    protected $primaryKey = 'jadwal_id';
    protected $table = 'jadwal';
    protected $guarded = ['jadwal_id'];
    public $timestamps = false;

    function bus(): BelongsTo
    {
        return $this->belongsTo(Bus::class, 'bus_id', 'bus_id');
    }
    function rute(): BelongsTo
    {
        return $this->belongsTo(Rute::class, 'rute_id', 'rute_id');
    }
}
