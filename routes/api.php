<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\AuthController;
use App\Http\Controllers\api\v1\UsersController;
use App\Http\Controllers\api\v1\NotificationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

# API Routes
Route::group(['prefix' => 'v1', 'namespace' => 'api\v1'], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('forgot-password', [AuthController::class, 'forgotPassword']);

    Route::middleware(['auth:api'])->group(function (){
        Route::get('logout', [AuthController::class, 'logout']);
        Route::post('store-login-device-details', [UsersController::class, 'storeLoginDeviceDetails']);
        Route::get('get-profile', [UsersController::class, 'getProfile']);
        Route::post('update-profile', [UsersController::class, 'updateProfile']);
        Route::post('update-password', [UsersController::class, 'updatePassword']);        
        Route::delete('delete-account', [UsersController::class, 'deleteAccount']);
        Route::get('userlist', [UsersController::class, 'userlist']);
    });

    Route::post('upload-file-local-storage', [UsersController::class, 'uploadFileLocalStorage']);
    Route::post('upload-files-local-storage', [UsersController::class, 'uploadFilesLocalStorage']);
    Route::post('upload-file-aws-s3', [UsersController::class, 'uploadFileAwsS3']);
    Route::post('generate-presigned-url', [UsersController::class, 'getPresignedUrl']);

    Route::post('send-push-notification', [NotificationController::class, 'sendPushNotification']);
    Route::post('send-email', [NotificationController::class, 'sendEmail']);
    Route::post('send-email-with-different-content', [NotificationController::class, 'sendEmailWithDifferentContent']);

    Route::get('optimize-clear', function () {\Artisan::call('optimize:clear');echo "Cache is cleared successfully.";exit;});
    Route::get('storage-link', function () {\Artisan::call('storage:link');echo "Storage is linked Successfully.";exit;});
});
