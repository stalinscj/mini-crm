<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'    => ['required', 'string', 'max:60', Rule::unique('companies')->ignore($this->company)],
            'email'   => ['required', 'string', 'email:filter','max:100', Rule::unique('companies')->ignore($this->company)],
            'website' => ['required', 'string', 'url', 'max:100', Rule::unique('companies')->ignore($this->company)],
        ];
    }
}
