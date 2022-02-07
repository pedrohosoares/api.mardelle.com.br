<?php

namespace App\Models\Tray;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Trayaddres extends Model
{
    use HasFactory;

    public $table = 'trayaddress';
    public $fillable = [
        'customer_id',
        'zip_code',
        'city',
        'state',
        'neighborhood',
        'country',
        'json'
    ];

    public function traycustomer() : BelongsTo
    {
        return $this->belongsTo(Traycustomer::class,'customer_id','customer_id');
    }
}
