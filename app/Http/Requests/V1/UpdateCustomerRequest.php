<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
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

    protected function prepareForValidation()
    {
        if ($this->postalCode) {
            $this->merge([
                'postal_code' => $this->postalCode
            ]);
        }
    }


    public function rules(): array
    {
        $method = $this->method();
        if ($method == 'PUT') {
            return [
                'name' => ['required'],
                'type' => ['required', 'in:individual,business'],
                'address' => ['required'],
                'address' => ['required'],
                'state' => ['required'],
                'postal_code' => ['required'],
                'city' => ['required'],
                'email' => ['required', 'email'],
            ];
        } else {
            return [
                'name' => ['sometimes', 'required'],
                'type' => ['sometimes', 'required', 'in:individual,business'],
                'address' => ['sometimes', 'required'],
                'address' => ['sometimes', 'required'],
                'state' => ['sometimes', 'required'],
                'postal_code' => ['sometimes', 'required'],
                'city' => ['sometimes', 'required'],
                'email' => ['sometimes', 'required', 'email'],
            ];
        }
    }
}
