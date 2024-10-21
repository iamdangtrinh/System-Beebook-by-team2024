<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class getLocationGHNContronller extends Controller
{
      private string $URL_API;
      private string $GHN_TOKEN;

      public function __construct()
      {
            $this->URL_API = env('URL_GHN_API');
            $this->GHN_TOKEN = env('GHN_TOKEN');
      }

      public function getProvincer()
      {
            return $this->sendRequestGHN('master-data/province');
      }

      public function getDistrict(Request $request)
      {
            return $this->sendRequestGHN('master-data/district?province_id=', $request->id);
      }
      public function getWard(Request $request)
      {
            return $this->sendRequestGHN('master-data/ward?district_id=', $request->id);
      }

      public function feeShipping(Request $request)
      {
            $payload = [
                  "to_district_id" => (int)$request->input('to_district_id'),
                  "to_ward_code" => $request->input('to_ward_code'),
                  "service_id" => 53321,
                  "weight" => 200,
                  "shop_id" => 5103752,
            ];

            return $this->postRequestGHN('v2/shipping-order/fee', $payload);
      }

      protected function sendRequestGHN($endpoint, $id = "")
      {
            $url = $this->URL_API . $endpoint . $id;

            try {
                  $response = Http::withHeaders([
                        'Content-Type' => 'application/json',
                        'Token' => $this->GHN_TOKEN,
                  ])->get($url);

                  if ($response->failed()) {
                        throw new \Exception('Lỗi khi kết nối tới API');
                  }
                  return $response->json();
            } catch (\Exception $e) {
                  // Xử lý ngoại lệ
                  echo $e->getMessage();
                  return null;
            }
      }

      protected function postRequestGHN($endpoint, $data = [])
      {
            $url = $this->URL_API . $endpoint;
            try {
                  $response = Http::withHeaders([
                        'Content-Type' => 'application/json',
                        'Token' => $this->GHN_TOKEN,
                        'ShopId' => '5103752',
                  ])->post($url, ($data));

                  // var_dump($response);

                  return $response->json();
            } catch (\Exception $e) {
                  // Xử lý ngoại lệ
                  echo $e->getMessage();
                  return null;
            }
      }
}
