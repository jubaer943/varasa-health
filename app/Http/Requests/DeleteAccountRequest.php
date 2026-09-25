<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class DeleteAccountRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'account_type' => ['required', 'integer', 'in:1,2'],
            'confirmation' => ['required', 'string', 'in:DELETE'],
        ];
    }

    // Validation fail করলে জোরপূর্বক JSON Response পাঠানোর নিয়ম
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status'  => false,
            'code'    => 422,
            'message' => $validator->errors()->first(), // অথবা $validator->errors() সব এররের জন্য
            'errors'  => $validator->errors(),
        ], 422));
    }
}
