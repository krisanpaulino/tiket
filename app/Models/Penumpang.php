<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Penumpang extends Model
{
    protected $primaryKey = 'penumpang_id';
    protected $table = 'penumpang';
    protected $guarded = ['penumpang_id'];
    public $timestamps = false;

    function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
