<?php

namespace App\Services;

use App\Models\Card;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class ThesieureServices extends Card
{
    protected $paymentGate = 'thesieure';
    protected $partner_id = '3123';
    protected $partner_key = '312312321';
    protected $api_url = 'http://abc.com';
    const NUMBER_RETRY = 3;
    const NUMBER_RETRY_WAIT = 3000;
    const STATUS_PARTNER_CARD_TRUE = 1;
    const STATUS_PARTNER_CARD_FALSE = -1;
    const STATUS_PARTNER_CARD_WRONG_VALUE = 2;
    const STATUS_PARTNER_BUSY = -2;

    public function send($card_id)
    {
        $card = Card::first($card_id);
        $data = $this->getDataForSendPartner($card);
        $response = Http::retry(3, 3000)->post($this->api_url, $data);
        return $card;
    }

    private function getDataForSendPartner($card)
    {
        $dataSend = [
            'partner_id' => $this->partner_id,
            'request_id' => Carbon::now(),
            'telco' => $this->convert_cardtype($card->cardtype),
            'amount' => $card->cardvalue,
            'serial' => $card->cardseri,
            'code' => $card->cardcode,
            'command' => 'charging',

        ];
        $dataSend['sign'] = $this->creatSign($this->partner_key, $dataSend);
        return $dataSend;
    }

    private function card_request_id()
    {

    }

    private function creatSign($partner_key, $params)
    {
        $data = array();

        $data['request_id'] = $params['request_id'];
        $data['code'] = $params['code'];
        $data['partner_id'] = $params['partner_id'];
        $data['serial'] = $params['serial'];
        $data['telco'] = $params['telco'];
        $data['command'] = $params['command'];
        ksort($data);
        $sign = $partner_key;
        foreach ($data as $item) {
            $sign .= $item;
        }

        //return $sign;

        return md5($sign);
    }


    public function callback($request)
    {
        $status = $request->status;
        $realvalue = $request->realvalue;
        $trans_id = $request->trans_id;
        $card = '';
        $userid = '';
        if ($status == self::STATUS_PARTNER_CARD_TRUE) {
            CardServices::cardTrueProccess($card);
        }
        if ($status == self::STATUS_PARTNER_CARD_FALSE) {
            CardServices::cardFalseProccess($card);
        }
        if ($status == self::STATUS_PARTNER_CARD_WRONG_VALUE) {
            CardServices::cardWrongValueProccess($card, $realvalue);
        }
    }

    private function convert_cardtype($cardtype)
    {
        switch ($cardtype) {
            case 'viettel' :
                $type = 'VIETTEL';
                break;
            case 'mobifone' :
                $type = 'MOBIFONE';
                break;
            case 'vinaphone' :
                $type = 'VINAPHONE';
                break;
            case  'zing':
                $type = 'zing';
                break;
            default:
                $type = null;
                break;
        }
        return $type;
    }
}
