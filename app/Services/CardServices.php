<?php

namespace App\Services;


use App\Models\Card;
use Illuminate\Support\Facades\Http;

class CardServices
{
    const NUMBER_RETRY = 3;
    const NUMBER_RETRY_WAIT = 3000;

    public function moneyAfterRate($money, $rate)
    {
        return $moneyAfterRate = $money - ($money * $rate / 100);
    }

    public function moneyAfterRate_wrongvalue($money, $rate)
    {
        $money = round($money / 2);
        return $this->moneyAfterRate($money, $rate);
    }

    public function cardTrueProccess($card)
    {

    }

    public function cardFalseProccess($card)
    {

    }

    public function cardWrongValueProccess($card, $realvalue)
    {

    }

    public function sendCallbackToCustomer($urlCallback, $data)
    {
        Http::retry(self::NUMBER_RETRY, self::NUMBER_RETRY_WAIT)->get($urlCallback, $data);
    }

}
