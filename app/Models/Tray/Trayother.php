<?php

namespace App\Models\Tray;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Trayother extends Model
{
    use HasFactory;

    public $fillable = [
        'order_id',
        'customer_id',
        'total',
        'partial_total',
        'date',
        'payment_form',
        'payment_date',
        'access_code',
        'coupon_discount',
        'status',
        'total',
        'json'
    ];

    protected $casts = [
        'json' => 'array'
    ];

    public function traycustomer() : BelongsTo
    {
        return $this->belongsTo(Traycustomer::class,'customer_id','customer_id');
    }
}
