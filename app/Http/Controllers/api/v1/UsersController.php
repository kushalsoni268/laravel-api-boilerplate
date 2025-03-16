<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Helpers\ResponseHelper;
use App\Helpers\UrlHelper;
use App\Http\Requests\v1\FileUploadRequest;
use App\Http\Requests\v1\FilesUploadRequest;
use App\Http\Requests\v1\UpdateProfileRequest;
use App\Http\Requests\v1\UpdatePasswordRequest;
use App\Http\Requests\v1\LoginDeviceRequest;
use App\Traits\AwsS3Trait;
use App\Traits\FileUploadTrait;
use App\Models\User;
use App\Models\LoginDevice;
use URL;

class UsersController extends Controller{

    use AwsS3Trait, FileUploadTrait;

    /**
    *   @OA\Get(
    *   path="/api/v1/get-profile",
    *   tags={"User"},
    *   summary="Get Profile",
    *   security={{"bearer":{}}},
    *   @OA\Response(response="200", description="Success"),
    *   @OA\Response(response="401", description="Unauthenticated"),
    *   @OA\Response(response="403",description="Forbidden")
    *   )
    */

    # Get Profile
    public function getProfile(Request $request) 
    {
        try{
            $data = User::getUserDetails(Auth::user()->id);                                            
            return ResponseHelper::success($data, trans('api.SUCCESS'), config('code.SUCCESS_CODE'));
        } catch (\Exception $e) {
            return  ResponseHelper::fail([], $e->getMessage(), config('code.EXCEPTION_ERROR_CODE'));
        }        
    }

    /**
    * @OA\Post(
    *   path="/api/v1/update-profile",
    *   tags={"User"},
    *   summary="Update Profile",
    *   security={{"bearer":{}}},
    *   @OA\Parameter(
    *       name="name",
    *       in="query",
    *       description="Name",
    *       required=true,
    *       @OA\Schema(type="string")
    *   ),
    *   @OA\Parameter(
    *       name="email",
    *       in="query",
    *       description="Email",
    *       required=true,
    *       @OA\Schema(type="string")
    *   ),
    *   @OA\Response(response="201", description="Profile has been updated successfully."),
    *   @OA\Response(response="422", description="Validation errors")
    * )
    */

    # Update Profile
    public function updateProfile(UpdateProfileRequest $request) 
    {
        try{            
            DB::beginTransaction();
            $data = User::updateProfile($request);
            DB::commit(); 
            
            return ResponseHelper::success($data, trans('api.UPDATE_PROFILE_SUCCESS'), config('code.SUCCESS_CODE'));
        } catch (\Exception $e) {
            DB::rollBack();
            return  ResponseHelper::fail([], $e->getMessage(), config('code.EXCEPTION_ERROR_CODE'));
        }        
    }

    /**
    * @OA\Post(
    *   path="/api/v1/update-password",
    *   tags={"User"},
    *   summary="Update Password",
    *   security={{"bearer":{}}},
    *   @OA\Parameter(
    *       name="current_password",
    *       in="query",
    *       description="Current Password",
    *       required=true,
    *       @OA\Schema(type="string")
    *   ),
    *   @OA\Parameter(
    *       name="password",
    *       in="query",
    *       description="Password",
    *       required=true,
    *       @OA\Schema(type="string")
    *   ),
    *   @OA\Response(response="201", description="Password has been updated successfully."),
    *   @OA\Response(response="422", description="Validation errors")
    * )
    */

    # Update Password
    public function updatePassword(UpdatePasswordRequest $request) 
    {
        try{                        
            if(!Hash::check($request->current_password, Auth::user()->password)){
                return ResponseHelper::fail([], trans('api.CURRENT_PASSWORD_NOT_MATCH'), config('code.UNAUTHORIZED_CODE'));                
            }
            
            DB::beginTransaction();
            $data = User::updatePassword($request);
            DB::commit(); 
            
            return ResponseHelper::success([], trans('api.PASSWORD_UPDATE_SUCCESS'), config('code.SUCCESS_CODE'));
        } catch (\Exception $e) {
            DB::rollBack();
            return  ResponseHelper::fail([], $e->getMessage(), config('code.EXCEPTION_ERROR_CODE'));
        }        
    }

    /**
    *   @OA\Delete(
    *   path="/api/v1/delete-account",
    *   tags={"User"},
    *   summary="Delete Account",
    *   security={{"bearer":{}}},
    *   @OA\Response(response="200", description="You account has been deleted successfully."),
    *   @OA\Response(response="401", description="Unauthenticated"),
    *   @OA\Response(response="403",description="Forbidden")
    *   )
    */

    # Delete Account
    public function deleteAccount()
    {
        try{                       
            $deleteAccount = User::deleteAccount();             
            return ResponseHelper::success([], trans('api.ACCOUNT_DELETE_SUCCESS'), config('code.SUCCESS_CODE'));
        }catch(\Exception $e){                  
            return  ResponseHelper::success([], $e->getMessage(), config('code.EXCEPTION_ERROR_CODE'));
        }
    }

    # Upload File In Local Storage
    public function uploadFileLocalStorage(FileUploadRequest $request) 
    {
        try{
            $folder = "upload";        
            $fileName = $this->uploadFile($request->file, $folder);
            $data = [
                "file_name" => $fileName,
                "file_url" => UrlHelper::getFilePath() . '/' . $folder . '/' . $fileName
            ];                                            
            return ResponseHelper::success($data, trans('api.SUCCESS'), config('code.SUCCESS_CODE'));
        } catch (\Exception $e) {
            return  ResponseHelper::fail([], $e->getMessage(), config('code.EXCEPTION_ERROR_CODE'));
        }        
    }

    # Upload Multiple Files In Local Storage
    public function uploadFilesLocalStorage(FilesUploadRequest $request) 
    {
        try{
            $folder = "upload";
            $data = $this->uploadFiles($request->file('file'), $folder);                                        
            return ResponseHelper::success($data, trans('api.SUCCESS'), config('code.SUCCESS_CODE'));
        } catch (\Exception $e) {
            return  ResponseHelper::fail([], $e->getMessage(), config('code.EXCEPTION_ERROR_CODE'));
        }        
    }

    # AWS S3 Bucket File Upload Demo
    public function uploadFileAwsS3(FileUploadRequest $request) 
    {
        try{
            $filePath = $this->uploadFileToAwsS3($request);
            $data = [
                "file_path" => $filePath
            ];                                            
            return ResponseHelper::success($data, trans('api.SUCCESS'), config('code.SUCCESS_CODE'));
        } catch (\Exception $e) {
            return  ResponseHelper::fail([], $e->getMessage(), config('code.EXCEPTION_ERROR_CODE'));
        }        
    }

    # Get Presigned URL
    public function getPresignedUrl(Request $request) 
    {
        try{
            $presignedUrl = $this->generatePresignedUrl($request->file_path);
            $data = [
                "url" => $presignedUrl
            ];                                            
            return ResponseHelper::success($data, trans('api.SUCCESS'), config('code.SUCCESS_CODE'));
        } catch (\Exception $e) {
            return  ResponseHelper::fail([], $e->getMessage(), config('code.EXCEPTION_ERROR_CODE'));
        }        
    }

    # Store Login Device Details
    public function storeLoginDeviceDetails(LoginDeviceRequest $request){                  
        try{
            $data = LoginDevice::storeOrUpdateLoginDeviceDetails($request);
            return ResponseHelper::success($data, trans('api.LOGIN_DEVICE_STORE_SUCCESS'), config('code.SUCCESS_CODE'));            
        }catch(\Exception $e){                  
            return  ResponseHelper::fail([], $e->getMessage(), config('code.EXCEPTION_ERROR_CODE'));
        }
    }

    # Store Login Device Details
    public function userlist(Request $request){
        try{
            $limit = isset($request->limit) && $request->limit != '' ? $request->limit : 10;
            $search = isset($request->search) && $request->search != '' ? $request->search : '';
            $column_name = isset($request->column_name) && $request->column_name != '' ? $request->column_name : 'id';
            $order_type = isset($request->order_type) && $request->order_type != '' ? $request->order_type : 'DESC';
            $data = User::where('id', '!=', Auth::user()->id)->when(!empty($search),function($q) use($search){
                $q->where(function($q) use($search){
                    $q->orWhere('id','LIKE','%'.$search.'%');
                    $q->orWhere('name','LIKE','%'.$search.'%');
                    $q->orWhere('email','LIKE','%'.$search.'%');
                });
            })->orderBy($column_name,$order_type)->paginate($limit);                                            
            return ResponseHelper::success($data, trans('api.SUCCESS'), config('code.SUCCESS_CODE'));
        } catch (\Exception $e) {
            return  ResponseHelper::fail([], $e->getMessage(), config('code.EXCEPTION_ERROR_CODE'));
        }  
    }
    
}