<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Other extends Model
{
    use HasFactory;
    public $fillable = [
        'field',
        'value'
    ];


    public function scopeGetTokenTray() : object
    {
        return $this->where('field','tray')->first();
    }
}
