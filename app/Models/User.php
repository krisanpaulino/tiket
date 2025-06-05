<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $primaryKey = 'user_id';
    protected $table = 'user';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'user_password',
        'user_type',
        'email'
    ];
    protected $guarded = [
        'password_confirmation'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'password_confirmation'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            // 'email_verified_at' => 'datetime',
            'user_password' => 'hashed',
        ];
    }
    function owner(): HasOne
    {
        return $this->hasOne(Owner::class, 'user_id', 'user_id');
    }
    function penumpang(): HasOne
    {
        return $this->hasOne(Penumpang::class, 'user_id', 'user_id');
    }

    // protected static function booted(): void
    // {
    //     static::creating(function (User $user) {
    //         $user->user_password = Hash::make($user->user_password);
    //         // $user->makeHidden('password_confirmation');
    //     });
    // }
}
