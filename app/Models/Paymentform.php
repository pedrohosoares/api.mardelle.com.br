<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paymentform extends Model
{
    use HasFactory;
    public $table = 'payment_forms';
    public $fillable = ['name'];
}
