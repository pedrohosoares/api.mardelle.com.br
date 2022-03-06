<?php

namespace App\Models\Tray;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;

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
        'json',
        'user_id'
    ];

    protected $casts = [
        'json' => 'array',
    ];

    public function traycustomer(): BelongsTo
    {
        return $this->belongsTo(Traycustomer::class, 'customer_id', 'customer_id');
    }

    public function afiliate(): BelongsToMany
    {
        return $this->belongsToMany(
            Trayother::class,
            'affiliate_trayother',
            'trayother_id',
            'affiliate_id'
        );
    }

    public function scopeGetTotalOrders(
        object $query,
        array $paymentsForm,
        string $dateStart,
        string $dateEnd
    ) {
        if (!empty($paymentsForm)) {
            $query = $query->whereIn('payment_form', $paymentsForm);
        }
        if (!empty($dateStart) and !empty($dateEnd)) {
            $query = $query->whereBetween('date', [$dateStart, $dateEnd]);
        }
        return $query->sum('total');
    }

    public static function getOrdersByUserId(
        $usersId,
        string $dateStart,
        string $dateEnd,
        $paymentForm
    ) {
        $sql = "select trayothers.date,SUM(trayothers.total) as total from locations
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
        $sql .= " GROUP BY trayothers.date";
        $sql .= " ORDER BY trayothers.date DESC";
        return DB::select($sql);
    }

    public static function getOrdersByUserTotalPaymentForm(
        $usersId,
        string $dateStart,
        string $dateEnd,
        $paymentForm
    ) {
        $sql = "select trayothers.payment_form,sum(trayothers.total) as total,count(trayothers.payment_form) as total_payment_form
        from locations
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
        $sql .= " GROUP BY trayothers.payment_form";
        return DB::select($sql);
    }

    public static function getOrdersByUserTotalStatus(
        $usersId,
        string $dateStart,
        string $dateEnd,
        $paymentForm
    ) {
        $sql = "select trayothers.status,sum(trayothers.total) as total,count(trayothers.payment_form) as total_payment_form
        from locations
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
        $sql .= " GROUP BY trayothers.status";
        return DB::select($sql);
    }

    public static function getOrdersByUserTotalSale(
        $usersId,
        string $dateStart,
        string $dateEnd,
        $paymentForm
    ) {
        $sql = "select SUM(trayothers.total) as total from locations
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
        $sql .= " ORDER BY trayothers.date DESC";
        return DB::select($sql);
    }

    public static function getOrdersByUserTicketMedium(
        $usersId,
        string $dateStart,
        string $dateEnd,
        $paymentForm
    ) {
        $sql = "select SUM(trayothers.total) / COUNT(trayothers.id) AS total from locations
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
        $sql .= " ORDER BY trayothers.date DESC";
        return DB::select($sql);
    }



    public static function getSalesByTotalClients(
        $usersId,
        string $dateStart,
        string $dateEnd,
        $paymentForm
    ) {
        $sql = "select COUNT(traycustomers.customer_id) as total from locations
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
        $sql .= " GROUP BY traycustomers.customer_id";
        return DB::select($sql);
    }

    public static function getSalesByTotal(
        $usersId,
        string $dateStart,
        string $dateEnd,
        $paymentForm
    ) {
        $sql = "select JSON_LENGTH(trayothers.json->>'$.ProductsSold') as total from locations
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
        return DB::select($sql);
    }
}
