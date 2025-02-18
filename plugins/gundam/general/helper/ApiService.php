<?php

namespace Gundam\General\Helper;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Support\Facades\DB;
use October\Rain\Exception\SystemException;

class ApiService
{
    public function requestPostApi($path, $param, $query = null)
    {
        $client = new Client(['verify' => false]);

        $url = $path;
        try {
            $response = $client->post($url, [
                'query' => $query,
                'json' => $param,
            ]);

            $body = $response->getBody();
            $content = $body->getContents();

            $result = json_decode($content, true);
//            $dataLog = [
//                'method' => 'POST',
//                'url' => $path,
//                'payload' => $param,
//                'query' => $query,
//                'status_code' => $response->getStatusCode(),
//                'response' => $content,
//            ];

            return $result;
        } catch (\Exception $e) {
            $dataLog = [
                'method' => 'POST',
                'url' => $path,
                'payload' => $param,
                'query' => $query,
                'status_code' => $e->getCode(),
                'response' => $e->getMessage(),
            ];
            return $dataLog;
        }
    }

    public function requestGetApi($path, $data = null)
    {
        $client = new Client(['verify' => false]);

        $url = $path;
        try {
            $response = $client->get($url, [
                'query' => $data,
            ]);

            $body = $response->getBody();
            $content = $body->getContents();

            $result = json_decode($content, true);

//            $dataLog = [
//                'method' => 'GET',
//                'url' => $path,
//                'payload' => null,
//                'query' => $data,
//                'status_code' => $response->getStatusCode(),
//                'response' => $content,
//            ];

            return $result;
        } catch (\Exception $e) {
            $dataLog = [
                'method' => 'GET',
                'url' => $path,
                'payload' => null,
                'query' => $data,
                'status_code' => $e->getCode(),
                'response' => $e->getMessage(),
            ];
            return $dataLog;
        }
    }
}
