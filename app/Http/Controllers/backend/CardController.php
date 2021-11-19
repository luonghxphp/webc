<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Card;
use Illuminate\Http\Request;


class CardController extends Controller
{
    protected $cardRepo;
    public function index()
    {
        $products = Card::all();
    }


}
