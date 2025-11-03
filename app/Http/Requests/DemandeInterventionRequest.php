<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DemandeInterventionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'iddemandeur'=>['required'],
            'idrolereceveur'=>['required'],
            'idsection'=>['required'],
            'idtypeintervention'=>['required'],
            'datedemande'=>['required'],
            'datesouhaite'=>['nullable'],
            'description'=>['nullable'],
            'motif'=>['nullable'],
        ];
    }
}
