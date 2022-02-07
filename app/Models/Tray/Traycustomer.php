<?php

namespace App\Models\Tray;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Traycustomer extends Model
{
    use HasFactory;

    public $fillable = [
        'customer_id',
        'cpf',
        'cnpj',
        'name',
        'email',
        'city',
        'zip_code',
        'state',
    ];

    protected static function booted()
    {
        //static::addGlobalScope(new TrayCustomerScope);
    }

    public function trayaddres(): HasMany
    {
        return $this->hasMany(Trayaddres::class, 'customer_id', 'customer_id');
    }

    public function trayother(): HasMany
    {
        return $this->hasMany(Trayother::class, 'customer_id', 'customer_id');
    }

    public function scopeRetriveTotalMoneyPay(
        object $query,
        array $zipCodes,
        string $dateStart,
        string $dateEnd): float {

        $customers = $query->select(['customer_id'])
            ->whereOr(function ($query) use ($zipCodes) {
                foreach ($zipCodes as $zips) {
                    $query = $query->whereBetween('zip_code', $zips);
                }
                return $query;
            });
        $total = ($customers->get())->map(function($customer) use ($dateStart, $dateEnd) {
            return $customer
            ->trayother
            //->whereBetween('date', [$dateStart, $dateEnd])
            ->sum('total');
        })[0];
        return $total;

    }

    public function scopeRetriveByStatusMoneyPay(
        object $query,
        array $zipCodes,
        string $dateStart,
        string $dateEnd) {

        $customers = $query->select(['customer_id'])
            ->whereOr(function ($query) use ($zipCodes) {
                foreach ($zipCodes as $zips) {
                    $query = $query->whereBetween('zip_code', $zips);
                }
                return $query;
            });
        $orders = ($customers->get())->map(function($customer) use ($dateStart, $dateEnd) {
            return $customer
            ->trayother
            //->whereBetween('date', [$dateStart, $dateEnd])
            ->groupBy("status");

        })[0];
        return $orders;

    }
}
