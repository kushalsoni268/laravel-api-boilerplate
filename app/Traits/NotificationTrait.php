<?php

namespace App\Traits;
use App\Jobs\SendEmailJob;

trait NotificationTrait
{
    # Send Push Notification (Android & Ios)
    public function sendPushNotificationTrait($registrationIds, $title, $message, $extra = null) {
        $firebaseUrl = config('const.FIREBASE_URL');
        $fcmKey = config('const.FIREBASE_FCM_KEY');

        $headers = array(
            'Authorization: key=' . $fcmKey,
            'Content-Type: application/json'
        );

        $fields = array(
            "registration_ids" => $registrationIds, // FCM Device Token
            "notification" => [
                "title" => $title,
                "body" => $message,
            ],
            "data" => $extra ?? null
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $firebaseUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);

        $resultArr = json_decode($result, true);

        if(is_null($resultArr)){
            return false;
        }

        if ($resultArr['success'] == 1) {
            return true;
        }

        return false;
    }

    # Send Email
    public function sendEmailTrait($bladeFile, $subject, $email, $data = [], $cc = '', $bcc = '')
    {
        $emailData = [
            '_blade' => $bladeFile,
            'subject' => $subject,
            'email' => $email,            
            'data' => $data
        ];

        if(isset($cc) && $cc !=''){
            $emailData['cc'] = $cc;   
        }
        if(isset($bcc) && $bcc !=''){
            $emailData['bcc'] = $bcc;   
        }

        dispatch(new SendEmailJob($emailData));

        return true;
    }
}
