<?php

namespace App\Utils;
use Illuminate\Support\Facades\Http;

class GHNService
{
    protected $baseUrl;
    protected $token;

    public function __construct()
    {
        $this->baseUrl = 'https://online-gateway.ghn.vn/shiip/public-api';
        $this->token = env('GHN_TOKEN');
    }

    private function getHeaders()
    {
        return [
            'Content-Type' => 'application/json',
            'Token' => env('GHN_TOKEN'),
        ];
    }

    public function calculateShippingFee($data)
    {
        $url = $this->baseUrl . '/v2/shipping-order/fee';

        $response = Http::withHeaders($this->getHeaders())->post($url, $data);

        return $response->json();
    }
}
