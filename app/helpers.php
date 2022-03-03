<?php

if (! function_exists('responseHTTP')) {
    function responseHTTP(int $statusCode, $message = null, $data = null): Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status_code' => $statusCode,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }
}

if(! function_exists('collectQuantityByTypeOrders')) {
    function collectQuantityByTypeOrders(object $orders)
    {
        $itens = [];
        foreach($orders as $index => $value)
        {
            if(!isset($itens[$index]['venda']))
            {
                $itens[$index]['venda'] = 0;
            }
            $itens[$index]['venda'] += $value->sum('total');
            $itens[$index]['quantidade'] = $value->count();
        }
        return json_encode($itens,JSON_UNESCAPED_UNICODE);
    }
}
