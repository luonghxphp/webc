<?php

namespace App\Process;

use App\Models\Card;
use App\Models\Cardtype;

class CardProcess extends Card
{
    const CARD_TRUE = 1;
    const CARD_FALSE = -1;
    const CARD_WRONG_VALUE = 2;

    public function getRate($cardType)
    {
        return $cardType = Cardtype::where(['code' => $cardType])->first();
    }

    public function cardTrueProccess($card_id)
    {

    }

    public function cardFalseProccess($card_id)
    {

    }

    public function cardWrongValueProccess($card_id, $realvalue)
    {

    }
}
