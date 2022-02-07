<?php

namespace App\Http\Controllers\Tray;

use App\Http\Controllers\Controller;
use App\Http\ApiTray\Tray;
use App\Http\Services\OtherServices;
use App\Http\Support\OrderSupport;
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

    public function get(string $orderId = '') : array
    {
        $page = OtherServices::get('order');
        $page = json_decode($page['value'],true);
        $total = $page['total'];
        $limit = $page['limit'];
        $page = $page['page'];
        $actualPage = $page * $limit;
        if($actualPage > $total){
            exit;
        }
        $page = $page + 1;
        return $this->tray->get('orders'.$orderId,'&page='.$page);
    }

    protected function save(array $orderTray)
    {
        $orders = $orderTray['Orders'];
        foreach($orders as $order)
        {
            $order = OrderSupport::orderingOrders($order);
            $customer = (new CustomerController($this->tray))->get($order['customer_id']);
            Trayother::updateOrCreate(
                ['order_id' => $order['id']],
                $order
            );
            $customer['Customer']['customer_id'] = $order['customer_id'];
            Traycustomer::updateOrCreate(
                [
                    'customer_id' => $order['customer_id']
                ],
                $customer['Customer']
            );

        }
        OtherServices::save('order',$orderTray['paging']);
    }

    public function create() : void
    {
        $this->save($this->get());
    }
}
