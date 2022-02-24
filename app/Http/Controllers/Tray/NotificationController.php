<?php

namespace App\Http\Controllers\Tray;

use App\Http\ApiTray\Tray;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{

    public function __construct(Request $request, Tray $tray)
    {
        $this->save($request->all());
        $this->order = (new OrderController($tray));
    }

    public function save(array $data): void
    {
        $data['json'] = json_encode($data, JSON_UNESCAPED_UNICODE);
        try {
           //Notification::create($data);
        } catch (\Throwable $th) {

        }
    }

    public function read(): void
    {
        $notifications = Notification::limit(50)->get();
        foreach ($notifications as $notification) {
            $this->processNotification($notification);
        }
    }

    protected function processNotification(object $notification): void
    {
        $json = json_decode($notification->json, true);
        $orderIDOrproductID = $notification->scope_id;
        switch ($notification->scope_name . "_" . $notification->act) {
            case "product_insert":
                // Tratamento da atualização produto
                break;
            case "product_update":
                // Tratamento da atualização do produto
            case "variant_stock_update":
                // Tratamento da atualização de estoque de uma variação de produto
                break;
            case "order_insert":
                // Tratamento da insersão de um novo pedido
                $order = $this->order->getSpecificOrder($orderIDOrproductID);
                $this->order->saveOrder($order);
                break;
            case "order_update":
                // Tratamento da insersão de um novo pedido
                $order = $this->order->getSpecificOrder($orderIDOrproductID);
                $this->order->saveOrder($order);
                break;
            case "customer_delete":
                // Tratamento da exclusão de um cliente
                break;
        }
    }
}
