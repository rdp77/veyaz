<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait CurrencyTrait
{
    /**
     * Add prefix for ID currency.
     *
     * @param  string  $id
     * @return string
     */
    public static function getCurrency($value)
    {
        return 'Rp. '.number_format($value);
    }

    /**
     * Currency format to text currency ID.
     *
     * @param  string  $id
     * @return string
     */
    public function currencyToText($value)
    {
        if ($value < 0) {
            $result = 'minus '.trim($this->denominator($value));
        } else {
            $result = trim($this->denominator($value));
        }

        return Str::upper($result).__(' RUPIAH');
    }

    /**
     * Currency format to denominator currency ID.
     *
     * @param  string  $id
     * @return string
     */
    public function denominator($value)
    {
        $value = abs($value);
        $letter = [
            '', 'satu', 'dua', 'tiga', 'empat', 'lima',
            'enam', 'tujuh', 'delapan', 'sembilan', 'sepuluh', 'sebelas',
        ];
        $toText = '';
        if ($value < 12) {
            $toText = ' '.$letter[$value];
        } elseif ($value < 20) {
            $toText = $this->denominator($value - 10).' belas';
        } elseif ($value < 100) {
            $toText = $this->denominator($value / 10).' puluh'.$this->denominator($value % 10);
        } elseif ($value < 200) {
            $toText = ' seratus'.$this->denominator($value - 100);
        } elseif ($value < 1000) {
            $toText = $this->denominator($value / 100).' ratus'.$this->denominator($value % 100);
        } elseif ($value < 2000) {
            $toText = ' seribu'.$this->denominator($value - 1000);
        } elseif ($value < 1000000) {
            $toText = $this->denominator($value / 1000).' ribu'.$this->denominator($value % 1000);
        } elseif ($value < 1000000000) {
            $toText = $this->denominator($value / 1000000).' juta'.$this->denominator($value % 1000000);
        } elseif ($value < 1000000000000) {
            $toText = $this->denominator($value / 1000000000).' milyar'.$this->denominator(fmod($value, 1000000000));
        } elseif ($value < 1000000000000000) {
            $toText = $this->denominator($value / 1000000000000).' trilyun'.$this->denominator(fmod($value, 1000000000000));
        }

        return Str::upper($toText);
    }
}
