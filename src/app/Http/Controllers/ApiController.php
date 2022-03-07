<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use App\Models\Coin;
use App\Models\GeneralStats;

use App\Services\Convert;

class ApiController extends Controller
{
    public $headers;

    public function __construct()
    {
        $this->headers = [
            'x-rapidapi-host' => 'coinranking1.p.rapidapi.com',
            'x-rapidapi-key' => '398ab7c41fmshac36de114e064e0p147bbbjsnc9e311cf11a3'
        ];
    }

    public function coins(Request $request)
    {
        $currency = $request->input('currency');
        // if(!$currency||$currency=='USD') {
        //     $cache = Cache::get("coins-$currency");
        //     if($cache) return $cache;
        //     $this->refreshAll();
        //     return Coin::orderBy('marketCap', 'desc')->take(50)->get();
        // } else {
            // $cache = Cache::get("coins-$currency");
            // if($cache) return $cache;
            $this->refreshAll();

            $coinsRaw = Coin::orderBy('marketCap', 'desc')->take(50)->get();
            $coins = [];
            foreach ($coinsRaw as $key => $coin) {
                // dd($coin);
                $coin['marketCap'] = round((new Convert())
                ->from("USD")
                ->to($currency)
                ->amount($coin['marketCap'])
                ->get(), 2);
                $coin['price'] = (new Convert())
                ->from("USD")
                ->to($currency)
                ->amount($coin['price'])
                ->get();
                $roundTo = $this->roundTo($coin['price']);
                $coin['price'] = round($coin['price'], $roundTo);
                // if ($coin['symbol']=="SHIB") {
                //     // dd($roundTo);
                // dd($coin['price']);
                // }
                $coin['24hVolume'] = round((new Convert())
                ->from("USD")
                ->to($currency)
                ->amount($coin['24hVolume'])
                ->get(), 2);

                $coins[] = $coin;
            }
            

            Cache::put("coins-$currency", $coins);
            return $coins;

    }

    public function refreshAll()
    {
        $data = [
            // 'limit' => 100,
        ];
        $coins = Http::withHeaders($this->headers)
            ->get('https://coinranking1.p.rapidapi.com/coins', $data)->json();
        $stats = [
            "total" => $coins['data']['stats']['total'],
            "totalCoins" => $coins['data']['stats']['totalCoins'],
            "totalMarkets" => $coins['data']['stats']['totalMarkets'],
            "totalExchanges" => $coins['data']['stats']['totalExchanges'],
            "totalMarketCap" => $coins['data']['stats']['totalMarketCap'],
            "total24hVolume" => $coins['data']['stats']['total24hVolume'],
        ];
        GeneralStats::updateOrCreate(
            ['id' => 1],
            $stats
        );
        Cache::put('stats-USD', $stats);
        

        foreach ($coins['data']['coins'] as $key => $item) {
            $data = [
                "symbol" => $item["symbol"],
                "name" => $item["name"],
                "color" => $item["color"],
                "iconUrl" => $item["iconUrl"],
                "marketCap" => $item["marketCap"],
                "price" => $item["price"],
                "listedAt" => $item["listedAt"],
                "tier" => $item["tier"],
                "change" => $item["change"],
                "changeNegative" => str_contains($item["change"], '-'),
                "rank" => $item["rank"],
                "sparkline" => $item["sparkline"],
                "24hVolume" => $item["24hVolume"],
                "btcPrice" => $item["btcPrice"],
            ];
            
            $coin = Coin::updateOrCreate(
                ['uuid' => $item['uuid']],
                $data,
            );
            $coins = Coin::orderBy('marketCap', 'desc')->take(50)->get();
            Cache::put('coins-USD', $coins, 60*10);
            // Cache::put($item['uuid'], $data, 600*4);
        }
        return 'done';
    }

    public function coin($uuid, Request $request)
    {
        $coin = Coin::where('uuid', $uuid)->first();
        if (!$coin) abort(404);
        $data['uuid'] = $uuid; 
        $data['currency'] = $request->input('currency') ?? 'USD';
        $data['timePeriod'] = $request->input('timePeriod') ?? '24h';
        $historyAndChange = $this->getCoinHistory($data);
        
        $coin = [
            'data' => $coin,
            'change' => $historyAndChange['change'],
            'history' => $historyAndChange['history'],
        ];
        return $coin;
    }

    public function getCoinHistory($request)
    {
        $uuid = $request['uuid'];
        $cacheName = $uuid."-".$request['currency']."-".$request['timePeriod'];
        $cache = Cache::get($cacheName);
        if($cache) return $cache;

        $history = Http::withHeaders($this->headers)
            ->get("https://coinranking1.p.rapidapi.com/coin/$uuid/history?timePeriod=".$request['timePeriod'])->json();
        if($history['status']!='success') abort(403);

        $response['change'] = $request['currency']=='USD' ? $history['data']['change'] : round((new Convert())
            ->from("USD")
            ->to($request['currency'])
            ->amount($history['data']['change'])
            ->get(), 2);

        foreach ($history['data']['history'] as $key => $item) {
            $value = $request['currency']=='USD' ? round($item['price'], 2) : round((new Convert())
            ->from("USD")
            ->to($request['currency'])
            ->amount($item['price'])
            ->get(), 2);
            
            $response['history'][] = [
                $item['timestamp'] * 1000,
                $value
            ];
        }

        Cache::put($cacheName, $response, 60*30);
        return $response;
    }

    public function generalStats(Request $request)
    {
        $currency = $request->input('currency');
        if(!$currency||$currency=='USD') {
            return Cache::get("stats-$currency") ?? GeneralStats::first();
        } else {
            $cache = Cache::get("stats-$currency");
            if($cache) return $cache;

            $stats = GeneralStats::first();
            $stats['totalMarketCap'] = round((new Convert())
                ->from("USD")
                ->to($currency)
                ->amount($stats['totalMarketCap'])
                ->get(), 2);
            $stats['total24hVolume'] = round((new Convert())
            ->from("USD")
            ->to($currency)
            ->amount($stats['total24hVolume'])
            ->get(), 2);

            Cache::put("stats-$currency", $stats);
            return $stats;
        }
    }

    public function roundTo(float $value)
    {
        $roundTo = 1;
        while ($value < 1) {
            $value = $value * 10;
            $roundTo++;
        }
        $roundTo+=1;
        return $roundTo;
    }
}
