<?php

namespace App\Models\Tray;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Affiliate extends Model
{
    use HasFactory;
    public $fillable = ['name','site','commission','id_external'];

    public function order() : BelongsToMany
    {
        return $this->belongsToMany(
            Trayother::class,
            'affiliate_trayother',
            'affiliate_id',
            'trayother_id'
        );
    }
}
