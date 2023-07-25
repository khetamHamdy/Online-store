<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CurrencyConverter
{
    private $apiKey;

    protected $baseUrl = 'https://free.currconv.com/api/v7';

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function convert(string $from, string $to, float $amount = 1): float
    {
        $q = "{$from}_{$to}";
        $response = Http::baseUrl($this->baseUrl)
            ->get('/convert', [
                'q' => $q,
                'compact' => 'y',
                'apiKey' => $this->apiKey,
            ]);

        $result = $response->json();
        // dd($response);

        return $result[$q]['val'] * $amount;
    }

    //  public static function convert($amount, $fromCurrency, $toCurrency)
    // {
    //     $supported = Config::get('currency.supported');

    //     $fromRate = $supported[$fromCurrency];
    //     $toRate = $supported[$toCurrency];

    //     return round(($amount / $fromRate) * $toRate, 2);
    // }
}
