<?php

namespace Database\Factories\Tray;

use App\Models\Tray\Trayother;
use Illuminate\Database\Eloquent\Factories\Factory;

class TrayotherFactory extends Factory
{
    protected $model = Trayother::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $payment = ['Dinheiro','Cartão de débito','Boleto'];
        $status = ['A ENVIAR','RECEBIDO'];
        return [
            'order_id' => rand(0, 99999),
            'customer_id' => '333999345',
            'total' => rand(0, 9999),
            'partial_total' => rand(0, 9999),
            'date'=> (string) date('2022-m-'.rand(1,28)),
            'payment_form'=> $payment[rand(0,2)],
            'access_code' => '1239ASSA902813JDS',
            'status' => $status[rand(0,1)],
            'json' => '{}'
        ];
    }
}
