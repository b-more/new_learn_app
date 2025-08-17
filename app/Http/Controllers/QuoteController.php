<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    public function randomQuote()
    {
        $quote = Quote::inRandomOrder()->first();
        return response()->json($quote);
    }
}
