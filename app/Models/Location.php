<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Location extends Model
{
    use HasFactory;

    public $fillable = ['neighborhood','zip_code_start','zip_code_end'];

    public function userLocation() : BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'user_locations',
            'location_id',
            'user_id',
        );
    }
}
