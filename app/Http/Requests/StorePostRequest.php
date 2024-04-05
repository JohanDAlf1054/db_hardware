<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'dates' => 'required',
            'bill_numbers' => 'required|unique:sales,bill_numbers|max:255',
            'taxes_total' => 'required',
            'values_total' => 'required|numeric',
            'discounts_total' => 'required|numeric',
            'net_total' => 'required|numeric',
            'clients_id' => 'required|exists:people,id',
        ];
    }
}
