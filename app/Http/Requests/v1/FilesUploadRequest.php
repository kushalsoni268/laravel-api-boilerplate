<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Helpers\ResponseHelper;

class FilesUploadRequest extends FormRequest
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
            'file.*' => 'mimes:jpeg,png,jpg,gif,svg,pdf'
        ];
    }    

    # Custom Messages
    public function messages() {
        return [
            'file.*.mimes' => 'Each file must be a JPEG, PNG, JPG, GIF, SVG, or PDF.',
        ];
    }

    # Custom Error Response
    protected function failedValidation(Validator $validator) {        
        throw new HttpResponseException(ResponseHelper::fail([], ResponseHelper::error_parse($validator->errors()), config('code.VALIDATION_ERROR_CODE')));
    }
}
