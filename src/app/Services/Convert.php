<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

class Convert
{
    private $api;
    private $from;
    private $to;
    private $amount;

    public function __construct()
    {
        $this->from = "USD";
        $this->to = "USD";
        $this->amount = 1;

        $this->api = $this->api();
    }

    public function from(string $from)
    {
        $this->from = $from;
        return $this;
    }

    public function to(string $to)
    {
        $this->to = $to;
        return $this;
    }

    public function amount(float $amount)
    {
        $this->amount = $amount;
        return $this;
    }

    public function get()
    {
        $fromCurrency = $this->from;
        $toCurrency = $this->to;
        $eurAmount = $this->amount / $this->api->rates->$fromCurrency;
        $targetAmount = $eurAmount * $this->api->rates->$toCurrency;
        return $targetAmount;
    }

    public function api()
    {
        $cache = Cache::get('convert');
        if($cache) return $cache;
        $req_url = 'https://api.exchangerate.host/latest';
        $response_json = file_get_contents($req_url);
        if(false !== $response_json) {
            try {
                $response = json_decode($response_json);
                if($response->success === true) {
                    Cache::put('convert', $response, 60*5);
                    return $response;
                }
            } catch(Exception $e) {
                return $e;
            }
        } 
    }
}