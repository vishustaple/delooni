<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Exception;
use Twilio\Rest\Client;

class Notification extends Model
{
    protected $table = "notifications";
    use HasFactory;
    const STATUS_NEW = 0;
    const STATUS_CLEAR = 1;
    const STATUS_ASSIGNED = 1;
    //public static function sendTwillioSms($message,$phone)
  
    function sendPushNotification($data = [], $sendPushNotification = true, $sendEmail = false, $sendSms = false)
    {

        try {
            $model = new self();
            $model->title = $data['title'];
            $model->description = $data['message'];
            $model->model_id =  $data['model_id'];
            $model->status = self::STATUS_NEW;
            $model->type = $data['type'];
            $model->to_user  = $data['to_user'];
            $model->from_user = auth()->user()->id;
            $model->save();
            if ($sendPushNotification) {
                $model->sendPushNotificationToDevice();
            }
            if ($sendEmail) {
                //code here
            }
            if ($sendSms) {
                $model->sendSms($data['sms_message']);
            }
            return true;
        } catch (\Throwable $e) {
            Log::emergency($e); 
            return false;
        }
    }
    public function sendPushNotificationToDevice()
    {
        if (!empty($this->getToUser->loginHistory)) {
            $toUser = $this->getToUser;
            $deviceTokens = $toUser->loginHistory;

            foreach ($deviceTokens as $deviceToken) {
                $serverKey = 'AAAAJx5kHao:APA91bFFmFjjDLGMVu9iW_PG-UvP8PZLCSJYnI-Hk_f2A0uZtsDG5U5ZHDy_k8eISBcEYYxOa0WSFzLNkFWj6d4ngxqJkF94KsjwV-STTf_p1BDL5zcFmWImUKn669-5JzqheyGrJ4HA';

                $URL = 'https://fcm.googleapis.com/fcm/send';

                $fields = array(
                    "to" => $deviceToken->device_token,
                    "data" => array("title" => $this->title, 'body' => $this->description),
                    "priority" => "high",
                    "notification"  => (object)$this->description,
                );

                $crl = curl_init();

                $headr = array();
                $headr[] = 'Content-type: application/json';
                $headr[] = 'Authorization:  key=' . $serverKey;
                curl_setopt($crl, CURLOPT_SSL_VERIFYPEER, false);

                curl_setopt($crl, CURLOPT_URL, $URL);
                curl_setopt($crl, CURLOPT_HTTPHEADER, $headr);

                curl_setopt($crl, CURLOPT_POST, true);
                curl_setopt($crl, CURLOPT_POSTFIELDS, json_encode($fields));
                curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);

                $rest = curl_exec($crl);

                if ($rest === false) {
                    Log::debug('Error on send push notification.');
                    return false;
                }
                // } else {
                //     $result_noti = 1;
                // }
                curl_close($crl);
                //                return $result_noti;
            }
        }
        return true;
    }
    public static function sendTwillioSms($message)
    {

        try {
            //$receiverNumber = '+91'.$phone;
            $receiverNumber = '+918352678630';
            $account_sid = getenv("TWILIO_SID");
            $auth_token = getenv("TWILIO_TOKEN");
            $twilio_number = getenv("TWILIO_FROM");
            $client = new Client($account_sid, $auth_token);
            $client->messages->create($receiverNumber, [
                'from' => $twilio_number,
                'body' => $message
            ]);
            return true;
        } catch (Exception $e) {
            Log::emergency($e->getMessage());
        }
    }


    public function jsonData()
    {
        $json = [];
        $json['id'] = $this->id;
        $json['title'] = $this->title;
        $json['description'] = $this->description;
        $json['created_at'] = $this->created_at;
        $json['updated_at'] = $this->updated_at;
        return $json;
    }
}
