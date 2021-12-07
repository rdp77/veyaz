<?php

namespace App\Http\Controllers\Template;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class CurrencyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public static function getCurrency($value)
    {
        return "Rp. " . number_format($value);
    }

    public function currencyToText($value)
    {
        if ($value < 0) {
            $result = "minus " . trim($this->denominator($value));
        } else {
            $result = trim($this->denominator($value));
        }

        return ucwords($result, " ") . __(' RUPIAH');
    }

    function denominator($value)
    {
        $value = abs($value);
        $letter = array(
            "", "satu", "dua", "tiga", "empat", "lima",
            "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas"
        );
        $toText = "";
        if ($value < 12) {
            $toText = " " . $letter[$value];
        } else if ($value < 20) {
            $toText = $this->denominator($value - 10) . " belas";
        } else if ($value < 100) {
            $toText = $this->denominator($value / 10) . " puluh" . $this->denominator($value % 10);
        } else if ($value < 200) {
            $toText = " seratus" . $this->denominator($value - 100);
        } else if ($value < 1000) {
            $toText = $this->denominator($value / 100) . " ratus" . $this->denominator($value % 100);
        } else if ($value < 2000) {
            $toText = " seribu" . $this->denominator($value - 1000);
        } else if ($value < 1000000) {
            $toText = $this->denominator($value / 1000) . " ribu" . $this->denominator($value % 1000);
        } else if ($value < 1000000000) {
            $toText = $this->denominator($value / 1000000) . " juta" . $this->denominator($value % 1000000);
        } else if ($value < 1000000000000) {
            $toText = $this->denominator($value / 1000000000) . " milyar" . $this->denominator(fmod($value, 1000000000));
        } else if ($value < 1000000000000000) {
            $toText = $this->denominator($value / 1000000000000) . " trilyun" . $this->denominator(fmod($value, 1000000000000));
        }

        return Str::upper($toText);
    }
}