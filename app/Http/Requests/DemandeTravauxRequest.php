<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DemandeTravauxRequest extends FormRequest
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
            'idsection' => ['required'],
            'idtypedemande' => ['required'],
            'idtypetravaux' => ['required'],
            'iddemandeur' => ['required'],
            'demandeur' => ['nullable'],
            'datedemande' => ['required'],
            'datesouhaite' => ['required'],
            'datereelle' => ['nullable'],
            'numeroserie' => ['nullable'],
            // 'statut' => ['required'],
            'motif' => ['required'],
            'description' => ['required'],
        ];
    }
}
