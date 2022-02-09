<?php

namespace App\Models\Tray;

use App\Http\Support\TotalMoneyDateCompleteSupport;
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
        if (empty($zipCodes)) {
            return 0.00;
        }
        $customers = $query->select(['customer_id'])
            ->where(function ($query) use ($zipCodes) {
                foreach ($zipCodes as $zips) {
                    $query = $query->orWhereBetween('zip_code', $zips);
                }
                return $query;
            });
        $customers = $customers->get();
        if ($customers->count() === 0) {
            return 0.00;
        }
        $total = ($customers)->map(function ($customer) use ($dateStart, $dateEnd) {
            return $customer
                ->trayother
                ->whereBetween('date', [$dateStart, $dateEnd])
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
                    $query = $query->orWhereBetween('zip_code', $zips);
                }
                return $query;
            });
        $orders = ($customers->get())->map(function ($customer) use ($dateStart, $dateEnd) {
            return $customer
                ->trayother
                ->whereBetween('date', [$dateStart, $dateEnd])
                ->groupBy("status");
        })[0];
        return $orders;
    }

    public function scopeRetriveByStatusAndTotalMoneyPay(
        object $query,
        array $zipCodes,
        string $dateStart,
        string $dateEnd) {
        $customers = $query->select(['customer_id'])
            ->where(function ($query) use ($zipCodes) {
                foreach ($zipCodes as $zips) {
                    $query = $query->orWhereBetween('zip_code', $zips);
                }
                return $query;
            });
        $orders = ($customers->get())->map(function ($customer) use ($dateStart, $dateEnd) {
            return $customer
                ->trayother
                ->whereBetween('date', [$dateStart, $dateEnd])
                ->groupBy("status");
        })[0];
        return TotalMoneyDateCompleteSupport::sumTotalByStatusAndDate($orders);
    }

    public function scopeRetriveByDateStatusAndTotalMoneyPay(
        object $query,
        array $zipCodes,
        string $dateStart,
        string $dateEnd,
        string $groupBy = 'status') {
        if (empty($zipCodes)) {
            return 0.00;
        }
        $customers = $query->select(['customer_id', 'zip_code'])
            ->where(function ($query) use ($zipCodes) {
                foreach ($zipCodes as $zips) {
                    $query = $query->orWhereBetween('zip_code', $zips);
                }
                return $query;
            });
        $customers = $customers->get();
        if ($customers->count() === 0) {
            return [];
        }
        $orders = ($customers)->map(function ($customer) use ($dateStart, $dateEnd, $groupBy) {
            return $customer
                ->trayother
                ->whereBetween('date', [$dateStart, $dateEnd])
                ->groupBy($groupBy);
        })[0];
        return TotalMoneyDateCompleteSupport::sumTotalByStatusAndDate($orders);
    }

    public function scopeRetriveStatusMoneyPayByMonth(
        object $query,
        array $zipCodes,
        string $dateStart,
        string $dateEnd) {
        $customers = $query->select(['customer_id'])
            ->where(function ($query) use ($zipCodes) {
                foreach ($zipCodes as $zips) {
                    $query = $query->orWhereBetween('zip_code', $zips);
                }
                return $query;
            });
        $orders = ($customers->get())->map(function ($customer) use ($dateStart, $dateEnd) {
            return $customer
                ->trayother
                ->whereBetween('date', [$dateStart, $dateEnd])
                ->groupBy("status");
        })[0];
        $dates = TotalMoneyDateCompleteSupport::sumMoneyByDateAndStatus($orders);
        return TotalMoneyDateCompleteSupport::completeArrayDateStatusByFirstAtLast($dates, $dateStart, $dateEnd);
    }
}
