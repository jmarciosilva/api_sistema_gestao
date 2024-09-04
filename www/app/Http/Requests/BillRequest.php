<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class BillRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'errors' => $validator->errors(),
        ], 422));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'bill_value' => 'required|decimal:2',
            'due_date' => 'required|date'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Campo nome é obrigatório',
            'bill_value.required' => 'Campo valor é obrigatório',
            'bill_value.decimal' => 'Campo valor deve ser decimal',
            'due_date.required' => 'Campo data de vencimento é obrigatório',
            'due_date.date' => 'Campo data de vencimento deve ser data',
        ];
    }
}
