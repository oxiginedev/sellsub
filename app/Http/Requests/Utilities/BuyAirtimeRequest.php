<?php

namespace App\Http\Requests\Utilities;

use App\Rules\Pin;
use App\Rules\SufficientBalance;
use Illuminate\Foundation\Http\FormRequest;

class BuyAirtimeRequest extends FormRequest
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
            'phone' => ['required', 'digits:11'],
            'network' => ['required', 'string'],
            'amount' => ['required', 'numeric', 'min:50', new SufficientBalance()],
            'pin' => ['required', 'numeric', 'digits:4', new Pin()]
        ];
    }
}
