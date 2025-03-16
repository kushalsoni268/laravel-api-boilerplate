<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Traits\NotificationTrait;

class NotificationController extends Controller{

    use NotificationTrait;

    # Send Push Notification
    public function sendPushNotification(Request $request)
    {
        try{            
            $registrationIds = array();
            $registrationIds[0] = "fA_d65M8QcGMcAPI7h9R-O:APA91bGKV2KTmYQcQsE6xpTf2T-mFduXPVHqJZ6zpPVnpPbJd8f6SbKua3cRxEmmV2ATpjV5ra3YkWNWa-xmh9_lQ3HS8pKCCRCWdqSWmiXIhVL0sui_gonWD96W9kwyVzSOA9kX_ESB"; // FCM Device Token
            $title = "Demo Notification";
            $message = "This is a demo notification for testing purpose.";
            $this->sendPushNotificationTrait($registrationIds, $title, $message);
            return ResponseHelper::success([], trans('api.SEND_PUSH_NOTIFICATION_SUCCESS'), config('code.SUCCESS_CODE'));
        }catch(\Exception $e){                  
            return  ResponseHelper::success([], $e->getMessage(), config('code.EXCEPTION_ERROR_CODE'));
        }
    }

    # Send Email
    public function sendEmail(Request $request)
    {
        try{        
            $data = [
                'name' => 'User1',
                'email' => 'user1@yopmail.com'
            ]; 

            $email = ['user1@yopmail.com', 'user2@yopmail.com', 'user3@yopmail.com'];
            $cc = 'user4@yopmail.com';
            
            $this->sendEmailTrait('email-demo-1', trans('email.DEMO_EMAIL'), $email, $data, $cc);

            return ResponseHelper::success([], trans('api.SEND_EMAIL_SUCCESS'), config('code.SUCCESS_CODE'));
        }catch(\Exception $e){                  
            return  ResponseHelper::success([], $e->getMessage(), config('code.EXCEPTION_ERROR_CODE'));
        }
    }

    # Send Email (With Different Content)
    public function sendEmailWithDifferentContent(Request $request)
    {
        try{        
            $users = [
                [
                    'name' => 'User1',
                    'email' => 'user1@yopmail.com'
                ],
                [
                    'name' => 'User2',
                    'email' => 'user2@yopmail.com'
                ],
                [
                    'name' => 'User3',
                    'email' => 'user3@yopmail.com'
                ]
            ];

            foreach($users as $user){
                $email = $user['email'];
                $cc = 'user4@yopmail.com';        
                $this->sendEmailTrait('email-demo-2', trans('email.DEMO_EMAIL'), $email, $user, $cc);
            }
           
            return ResponseHelper::success([], trans('api.SEND_EMAIL_SUCCESS'), config('code.SUCCESS_CODE'));
        }catch(\Exception $e){                  
            return  ResponseHelper::success([], $e->getMessage(), config('code.EXCEPTION_ERROR_CODE'));
        }
    }
    
}