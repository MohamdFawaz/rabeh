<?php

namespace App\Http\Services;


class PushNotificationService
{


    public static function sendTransactionNotification($message,$operation,$amount,$currency, $id)
    {


        $url = 'https://fcm.googleapis.com/fcm/send';

        $fields = array(
            'registration_ids' => array(
                $id
            ),
            'data' => array(
                "message" => $message,
                "amount" => $amount,
                "action" => $operation,
                "currency" => $currency
            ),
            'notification' => array(
                "message" => $message,
                "amount" => $amount,
                "action" => $operation,
                "currency" => $currency
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
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
}
