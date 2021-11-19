<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CardChargeRequest
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
        try {
            $cardType = $request->cardtype;
            $cardSeri = $request->cardseri;
            $cardCode = $request->cardcode;
            if(!$cardSeri || !$cardCode || !$cardType){
                return response(json_encode(array('status' => -100, 'message' => 'Thiếu thông tin!')), 200);
            }
            if ($cardType == 'viettel') {
                if (strlen($cardSeri) != 14 || strlen($cardCode) != 15) {
                    return response(json_encode(array('status' => -101, 'message' => 'Thẻ Viettel sai định dạng!')), 200);
                }
            }
            if ($cardType == 'mobifone') {
                if (strlen($cardSeri) != 15 || strlen($cardCode) != 12) {
                    return response(json_encode(array('status' => -101, 'message' => 'Thẻ Mobifone định dạng!')), 200);
                }
            }

            if ($cardType == 'vinaphone') {
                if (strlen($cardSeri) != 14 || strlen($cardCode) != 14) {
                    return response(json_encode(array('status' => -101, 'message' => 'Thẻ Vinaphone sai định dạng!')), 200);
                }
            }
        } catch (Exception $e) {
            $result['mes'] = $e->getMessage();
        }
        return $next($request);
    }
}
