<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tray\Trayother;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function salesByPaymentForm(Request $request)
    {
        if ($request->user == 'no') {
            return Trayother::getOrdersByUserTotalPaymentFormNoUser(
                $request->user,
                $request->date_start,
                $request->date_end,
                $request->payments_form
            );
        } else {
            if(!getUserLoggedIsAdmin()){
                $request->user =  auth()->user()->id;
            }
            return Trayother::getOrdersByUserTotalPaymentForm(
                $request->user,
                $request->date_start,
                $request->date_end,
                $request->payments_form
            );
        }
    }

    public function salesByStatus(Request $request)
    {
        if ($request->user == 'no') {
            return Trayother::getOrdersByUserTotalStatusNoUser(
                $request->user,
                $request->date_start,
                $request->date_end,
                $request->payments_form
            );
        } else {
            if(!getUserLoggedIsAdmin()){
                $request->user =  auth()->user()->id;
            }
            return Trayother::getOrdersByUserTotalStatus(
                $request->user,
                $request->date_start,
                $request->date_end,
                $request->payments_form
            );
        }
    }

    public function getOrdersByUserTotalSale(Request $request)
    {
        if ($request->user == 'no') {
            return Trayother::getOrdersByUserTotalSaleNoUser(
                $request->user,
                $request->date_start,
                $request->date_end,
                $request->payments_form
            );
        } else {
            if(!getUserLoggedIsAdmin()){
                $request->user =  auth()->user()->id;
            }
            return Trayother::getOrdersByUserTotalSale(
                $request->user,
                $request->date_start,
                $request->date_end,
                $request->payments_form
            );
        }
    }

    public function getMediumTicket(Request $request)
    {
        if ($request->user == 'no') {
            return Trayother::getOrdersByUserTicketMediumNoUser(
                $request->user,
                $request->date_start,
                $request->date_end,
                $request->payments_form
            );
        } else {
            if(!getUserLoggedIsAdmin()){
                $request->user =  auth()->user()->id;
            }
            return Trayother::getOrdersByUserTicketMedium(
                $request->user,
                $request->date_start,
                $request->date_end,
                $request->payments_form
            );
        }
    }

    public function getOrdersByUserId(Request $request)
    {
        if ($request->user == 'no') {
            return Trayother::getOrdersByUserIdNoUser(
                $request->user,
                $request->date_start,
                $request->date_end,
                $request->payments_form
            );
        } else {
            if(!getUserLoggedIsAdmin()){
                $request->user =  auth()->user()->id;
            }
            return Trayother::getOrdersByUserId(
                $request->user,
                $request->date_start,
                $request->date_end,
                $request->payments_form
            );
        }
    }

    public function salesByTotalClients(Request $request)
    {
        if($request->user == 'no'){
            $query = Trayother::getSalesByTotalClientsNoUser(
                $request->user,
                $request->date_start,
                $request->date_end,
                $request->payments_form);
        }else{
            if(!getUserLoggedIsAdmin()){
                $request->user =  auth()->user()->id;
            }
            $query = Trayother::getSalesByTotalClients(
                $request->user,
                $request->date_start,
                $request->date_end,
                $request->payments_form);
        }
        $return['total'] = collect($query)->sum('total');
        return [$return];
    }

    public function salesByTotal(Request $request)
    {
        if($request->user == 'no')
        {
            $query = Trayother::getSalesByTotalNoUser(
                $request->user,
                $request->date_start,
                $request->date_end,
                $request->payments_form
            );
        }else{
            if(!getUserLoggedIsAdmin()){
                $request->user =  auth()->user()->id;
            }
            $query = Trayother::getSalesByTotal(
                $request->user,
                $request->date_start,
                $request->date_end,
                $request->payments_form
            );
        }
        $return['total'] = collect($query)->sum('total');
        return [$return];
    }

}
