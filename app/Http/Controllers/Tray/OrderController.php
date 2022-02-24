<?php

namespace App\Http\Controllers\Tray;

use App\Http\ApiTray\Tray;
use App\Http\Controllers\Controller;
use App\Http\Services\OtherServices;
use App\Http\Support\OrderSupport;
use App\Models\Paymentform;
use App\Models\Tray\Traycustomer;
use App\Models\Tray\Trayother;

class OrderController extends Controller
{
    public $tray;

    public function __construct(Tray $tray)
    {
        $this->tray = new $tray;
    }

    public function show()
    {
        $trayother = Trayother::limit(env('PAGINATE'))->paginate()->toArray();
        return $trayother;
    }

    public function getModifiedByDateNow(): void
    {
        $tray = $this->tray->get('orders', '&modified=' . simpleDateRight());
        $this->save($tray);
    }

    public function get(): array
    {
        return $this->tray->get('orders', '&sort=id_desc&page=2');
    }

    public function getSpecificOrder(string $orderId = ''): array
    {
        return $this->tray->get('orders/' . $orderId, '');
    }

    protected function save(array $orderTray)
    {
        $orders = $orderTray['Orders'];
        foreach ($orders as $order) {
            $this->saveOrder($order);
        }
        OtherServices::save('order', $orderTray['paging']);
    }

    public function create(): void
    {
        $this->save($this->get());
    }

    public function saveOrder(array $order): void
    {
        $order = OrderSupport::orderingOrders($order);
        $customer = (new CustomerController($this->tray))->get($order['customer_id']);
        Trayother::updateOrCreate(
            ['order_id' => $order['id']],
            $order
        );
        Paymentform::updateOrCreate(
            ['name' => $order['payment_form']],
            ['name' => $order['payment_form']]
        );
        Traycustomer::updateOrCreate(
            [
                'customer_id' => $order['customer_id'],
            ],
            $customer['Customer']
        );
    }
}
