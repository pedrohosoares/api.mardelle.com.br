<?php

namespace App\Http\Controllers\Tray;

use App\Http\ApiTray\Tray;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Tray\Affiliate;
use Illuminate\Http\Request;

class NotificationController extends Controller
{

    public function __construct(Request $request, Tray $tray)
    {
        $this->save($request->all());
        $this->order = (new OrderController($tray));
        $this->productSold = (new ProductSoldController($tray));
        $this->product = (new ProductController($tray));
    }

    public function save(array $data): void
    {
        $data['json'] = json_encode($data, JSON_UNESCAPED_UNICODE);
        try {
           Notification::create($data);
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
        $orderIDOrproductID = $notification->scope_id;
        switch ($notification->scope_name . "_" . $notification->act)
        {
            case "order_insert":
                $order = $this->order->getSpecificOrder($orderIDOrproductID);
                $affiliate = Affiliate::select(['user_id'])->where('id_external',$order['Order']['partner_id'])->first();
                if(!empty($affiliate)){
                    $order['Order']['user_id'] = $affiliate['user_id'];
                }
                $this->order->saveOrder($order);
                $this->delete($notification->id);
                break;
            case "order_update":
                $order = $this->order->getSpecificOrder($orderIDOrproductID);
                $affiliate = Affiliate::select(['user_id'])->where('id_external',$order['Order']['partner_id'])->first();
                if(!empty($affiliate)){
                    $order['Order']['user_id'] = $affiliate['user_id'];
                }
                $this->order->saveOrder($order);
                $this->delete($notification->id);
                break;
        }
    }

    public function delete(int $id) : void
    {
        try {
            Notification::find($id)->delete();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
