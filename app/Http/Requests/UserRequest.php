<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $rules = [
            'idemploye' => ['nullable'],
            'username' => ['required', 'max:255'],
            'email'    => ['nullable', 'email', 'max:255'],
            'role'     => ['required'],
        ];

        if ($this->isMethod('post')) {
            $rules['password'] = ['required', 'min:5'];
        } else {
            $rules['password'] = ['nullable', 'min:5'];
        }

        return $rules;
    }
}
