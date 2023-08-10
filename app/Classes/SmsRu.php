<?php

namespace App\Classes;

use GuzzleHttp\Client;

class SmsRu
{
    public function sendSms($phone, $message)
    {
        $client = new Client();

        $apiUrl = 'https://sms.ru/sms/send';
        $apiKey = '81424331-83E5-EF22-0727-4117A70F9003';

        $response = $client->post($apiUrl, [
            'form_params' => [
                'api_id' => $apiKey,
                'to' => $phone,
                'msg' => $message,
                'json' => 1,
                'test' => 1
            ],
        ]);

        $data = json_decode($response->getBody(), true);
        $answer = $data['sms'][$phone]['status'];

        return $answer;

//        $statusCode = $response->getStatusCode();
    }

    public function call($phone)
    {
        $client = new Client();

        $apiUrl = 'https://sms.ru/code/call';
        $apiKey = '81424331-83E5-EF22-0727-4117A70F9003';

        $response = $client->post($apiUrl, [
            'form_params' => [
                'api_id' => $apiKey,
                'phone' => $phone,
                'ip' => -1
            ],
        ]);

        $statusCode = $response->getStatusCode();
    }
}
