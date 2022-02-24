<?php

namespace App\Http\Controllers\Tray;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function __construct(Request $request)
    {
        $this->save($request->all());
    }

    public function save(array $data): void
    {
        $data['json'] = json_encode($data,JSON_UNESCAPED_UNICODE);
        try {
           //Notification::create($data);
        } catch (\Throwable $th) {

        }
    }
}
