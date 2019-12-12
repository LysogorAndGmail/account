<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BuyModuleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'org'    => ['required', 'exists:organizations,id'],
            'module' => ['required', 'exists:modules,id'],
            'years'  => ['required', 'numeric'],
        ];
    }
}
