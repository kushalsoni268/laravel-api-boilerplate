<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Helpers\ResponseHelper;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email:rfc,dns|unique:users,email,' . auth()->user()->id 
        ];
    }   

    # Custom Error Response
    protected function failedValidation(Validator $validator) {        
        throw new HttpResponseException(ResponseHelper::fail([], ResponseHelper::error_parse($validator->errors()), config('code.VALIDATION_ERROR_CODE')));
    }
}
