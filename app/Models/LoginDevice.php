<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class LoginDevice extends Model
{
    use HasFactory;

    public $table = 'login_device';      

    # Store Or Update Login Device Details
    public static function storeOrUpdateLoginDeviceDetails($request){
        $userId = Auth::user()->id;
        $deviceData = LoginDevice::where(['user_id' => $userId, 'platform' => $request->platform, 'device_id' => $request->device_id])->first();
        if($deviceData){   
            $deviceData->device_name = $request->device_name;
            $deviceData->token = $request->bearerToken();
            $deviceData->push_token = $request->push_token;            
            $deviceData->app_version = $request->app_version;
            $deviceData->os_version = $request->os_version;
            $deviceData->time_zone = $request->time_zone;
            $deviceData->save();            
        }else{
            $deviceData = new LoginDevice();
            $deviceData->user_id = $userId;
            $deviceData->device_name = $request->device_name;
            $deviceData->platform = $request->platform;
            $deviceData->device_id = $request->device_id;
            $deviceData->token = $request->bearerToken();            
            $deviceData->push_token = $request->push_token;            
            $deviceData->app_version = $request->app_version;
            $deviceData->os_version = $request->os_version;
            $deviceData->time_zone = $request->time_zone;            
            $deviceData->save();
        }
        return $deviceData;
    }    
}
