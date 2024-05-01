<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreditNotePostRequest extends FormRequest
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
            'date_invoice' => 'required',
            'sellers' => 'required',
            'payments_methods' => 'required',
            'gross_totals' => 'required',
            'taxes_total' => 'required',
            'net_total' => 'required',
            'date_credit_notes'=> 'required',
            'reason' => 'required',
            'clients_id'=> 'required',
            'sale_id'=> 'required'
        ];
    }
}
