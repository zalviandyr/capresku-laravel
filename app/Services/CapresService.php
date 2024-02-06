<?php

namespace App\Services;

use App\Datum\CapresData;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class CapresService
{
    /**
     * @return \App\Datum\CapresData[]
     */
    public function getCapres(): array
    {
        $json = Cache::remember('capres', 3600, function() {
            $response = Http::get('https://mocki.io/v1/92a1f2ef-bef2-4f84-8f06-1965f0fca1a7');
            return $response->json();
        });

        return CapresData::from($json);
    }
}
