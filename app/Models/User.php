<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends \TCG\Voyager\Models\User
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeGetZipCodesByUser(object $query): object
    {
        return $query->select(['locations.zip_code_start', 'locations.zip_code_end'])
            ->join('user_locations', 'users.id', 'user_locations.user_id')
            ->join('locations', 'locations.id', 'user_locations.location_id')
            ->get();
    }

    public function customerZipCodes(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'user_locations',
            'location_id',
            'user_id'
        );
    }
}
