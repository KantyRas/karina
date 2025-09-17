<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DemandeAchatRequest extends FormRequest
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
            'iddemandeur' => ['required'],
            'idreceveur' => ['nullable'],
            'datedemande' => ['required', 'date'],
            'iddemande_travaux' => ['nullable'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.code' => ['nullable', 'string', 'max:50'],
//            'items.*.designation' => ['required', 'exists:articles,idarticle'],
            'items.*.designation' => ['required'],
            'items.*.quantitedemande' => ['required', 'integer', 'min:1'],
            'items.*.unite' => ['nullable', 'string', 'max:20'],
        ];
    }
}
