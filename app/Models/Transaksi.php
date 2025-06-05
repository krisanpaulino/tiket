<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaksi extends Model
{
    protected $primaryKey = 'transaksi_id';
    protected $table = 'transaksi';
    protected $guarded = ['transaksi_id'];
    public $timestamps = false;

    function jadwal(): BelongsTo
    {
        return $this->belongsTo(Jadwal::class, 'jadwal_id', 'jadwal_id');
    }
    function penumpang(): BelongsTo
    {
        return $this->belongsTo(Penumpang::class, 'penumpang_id', 'penumpang_id');
    }
    function tiket(): HasMany
    {
        return $this->hasMany(Tiket::class, 'transaksi_id', 'transaksi_id');
    }
}
