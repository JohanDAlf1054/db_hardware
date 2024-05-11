<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSalesRequest extends FormRequest
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
            'bill_numbers' => 'required|unique:sales,bill_numbers', // Asegura que el número de factura sea único en la tabla sales
            'sellers' => 'required',
            'payments_methods' => 'required' ,
            'gross_totals' => 'required' ,
            'taxes_total' => 'required' ,
            'net_total' => 'required' ,
            'clients_id'=> 'required|exists:people,id'
        ];
    }   
    protected function prepareForValidation()
    {
        $this->merge([
            'bill_numbers' => $this->bill_prefix . $this->bill_numbers,
        ]);
}

}