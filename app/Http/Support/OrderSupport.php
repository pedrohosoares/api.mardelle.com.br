<?php
namespace App\Http\Support;

class OrderSupport
{

    public static function orderingOrders(array $order): array
    {
        $order = $order['Order'];
        $order['status'] = $order['status'];
        $order['order_id'] = $order['id'];
        $order['payment_date'] = $order['payment_date'] == '0000-00-00' ? null : $order['payment_date'];
        $order['date'] = $order['date'] == '0000-00-00' ? null : $order['date'];
        $order['json'] = $order;
        return $order;
    }

    public static function sumMoneysObject(object $orderByStatus) : array
    {
        return $orderByStatus->map(function ($values, $index) {
            return $values->reduce(function ($index,$value) {
                return $value->sum('total');
            });
        })->toArray();
    }

}
