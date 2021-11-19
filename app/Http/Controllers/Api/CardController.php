<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Process\CardProcess;
use Illuminate\Http\Request;

class CardController extends Controller
{
    //
    public function charging(Request $request)
    {
        try {
            $data['status'] = 1;
            $cardType = $request->cardtype;
            $cardSeri = $request->cardseri;
            $cardCode = $request->cardcode;
            $cardValue = $request->cardvalue;
            $merchant_id = $request->merchant_id;
            $partner = 'wait';
            $user = $this->checkingMerchant($merchant_id);

            $data['data'] = $cardType;


        } catch (\Exception $e) {
            $data['message'] = $e->getMessage();
        }

        return response()->json($data);
    }

    private function checkingMerchant($merchant_id)
    {
        $user = User::where(['merchant_id' => $merchant_id, 'status' => 1])->first();
        if (!$user)  throw new \Exception('Tài khoản không tồn tại hoặc đã xóa'); ;
        return $user;
    }

}
