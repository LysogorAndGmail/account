<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrganizationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'    => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'phone'   => ['required', 'max:255'],
            'email'   => ['required', 'string', 'email', 'max:255', 'unique:organizations,email,' . $this->id],
            'reg'     => ['required', 'max:255', 'unique:organizations,reg,' . $this->id],
        ];
    }
}
