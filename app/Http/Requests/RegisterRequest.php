<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required',
            'email' => 'required|unique:users,email',
            'phone_number' => 'required',
            'document_type'=>'required',
            'identification_number'=>'required|unique:users,identification_number',
            'password' => 'required|min:8'
        ];
    }
}
