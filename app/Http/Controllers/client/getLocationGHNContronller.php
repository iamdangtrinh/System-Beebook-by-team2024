<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class getLocationGHNContronller extends Controller
{
      private string $URL_API;
      private string $GHN_TOKEN;

      public function __construct()
      {
            $this->URL_API = env('URL_GHN_API');
            $this->GHN_TOKEN = env('GHN_TOKEN');
      }

      public function getProvincer() {
            return $this->sendRequestGHN('province');
      }
      
      public function getDistrict(Request $request) {
            return $this->sendRequestGHN('district?province_id=', $request->id);
      }
      public function getWard(Request $request) {
            return $this->sendRequestGHN('ward?district_id=', $request->id);
      }

      protected function sendRequestGHN($endpoint, $id = "")
      {
            $ch = curl_init($this->URL_API . $endpoint .$id);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                  'Content-Type: application/json',
                  'Token: ' . $this->GHN_TOKEN
            ));
            $response = curl_exec($ch);
            curl_close($ch);
            if ($response === false) {
                  echo 'Lỗi khi kết nối tới API';
                  return null;
            }
            $result = json_decode($response, true);
            return $result;
      }
}
