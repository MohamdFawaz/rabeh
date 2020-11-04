<?php

namespace App\Http\Services;


class PushNotificationService
{


    public static function sendTransactionNotification($message,$operation,$amount,$currency, $id)
    {


        $url = 'https://fcm.googleapis.com/fcm/send';

        $msg = array
        (
            'title'		=> 'This is a title. title',
            'subtitle'	=> 'This is a subtitle. subtitle',
            'body' => [
                "message" => $message,
                "amount" => $amount,
                "action" => $operation,
                "currency" => $currency
            ]
        );
        $fields = array(
            'registration_ids' => array(
                $id
            ),
            'data' => array (
                'title'		=> 'This is a title. title',
                'subtitle'	=> 'This is a subtitle. subtitle',
                "message" => $message,
                "amount" => $amount,
                "action" => $operation,
                "currency" => $currency,
                "body" => [
                    "message" => $message,
                    "amount" => $amount,
                    "action" => $operation,
                    "currency" => $currency,
                ]
            )
        );
        $fields = json_encode($fields);

        $headers = array(
            'Authorization: key=' . env('FIREBASE_API_KEY'),
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
}
