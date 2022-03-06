<?php

namespace App\Models\Tray;

use App\Http\Support\TotalMoneyDateCompleteSupport;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

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
        string $dateEnd,
        string $paymentsForm,
        string $userId
        ): float {
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
        $total = ($customers)->map(function ($customer) use ($dateStart, $dateEnd, $paymentsForm) {
            return $customer
                ->trayother
                ->whereIn('payment_form',$paymentsForm)
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
        string $groupBy = 'status',
        string $paymentsForm,
        string $userId
        ) {
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
        $orders = ($customers)->map(function ($customer) use (
            $dateStart,
            $dateEnd,
            $groupBy,
            $paymentsForm,
            $userId) {
            return $customer
                ->trayother
                ->whereBetween('date', [$dateStart, $dateEnd])
                ->whereIn('payment_form',$paymentsForm)
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

    public static function getTotalSalesByAddress(
        $usersId,
        string $dateStart,
        string $dateEnd,
        $paymentForm
    )
    {
        $sql = "select CONCAT(traycustomers.city,' - ',traycustomers.state) AS location,SUM(trayothers.total) as total from locations
        join traycustomers ON traycustomers.zip_code BETWEEN locations.zip_code_start AND locations.zip_code_end
        join trayothers ON traycustomers.customer_id = trayothers.customer_id
        AND trayothers.date BETWEEN '{$dateStart}' AND '{$dateEnd}'
        join user_locations ON user_locations.location_id = locations.id
        join users ON users.id = user_locations.user_id OR trayothers.user_id = users.id
        where 1=1";
        if (!empty($usersId)) {
            $sql .= " AND users.id = {$usersId}";
        }
        if (!empty($paymentForm)) {
            $sql .= " AND trayothers.payment_form IN ('{$paymentForm}')";
        }
        $sql .= " GROUP BY traycustomers.city,traycustomers.state";
        return DB::select($sql);
    }

    public static function getTotalSalesByAddressNoUser(
        $usersId,
        string $dateStart,
        string $dateEnd,
        $paymentForm
    )
    {
        $sql = "select CONCAT(traycustomers.city,' - ',traycustomers.state) AS location,SUM(trayothers.total) as total from locations
        join traycustomers ON NOT traycustomers.zip_code BETWEEN locations.zip_code_start AND locations.zip_code_end
        join trayothers ON traycustomers.customer_id = trayothers.customer_id
        AND trayothers.date BETWEEN '{$dateStart}' AND '{$dateEnd}'
        join user_locations ON user_locations.location_id = locations.id
        join users ON users.id = user_locations.user_id OR trayothers.user_id = users.id
        where 1=1";
        if (!empty($paymentForm)) {
            $sql .= " AND trayothers.payment_form IN ('{$paymentForm}')";
        }
        $sql .= " GROUP BY traycustomers.city,traycustomers.state";
        return DB::select($sql);
    }
}
