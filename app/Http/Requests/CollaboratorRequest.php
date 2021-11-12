<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CollaboratorRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'company_id' => 'required|integer|exists:companies,id,deleted_at,NULL',
            'name'       => 'required|string|max:60',
            'last_name'  => 'required|string|max:60',
            'email'      => ['required', 'string', 'email:filter','max:100', Rule::unique('collaborators')->ignore($this->collaborator)],
            'phone'      => 'required|string|digits:9',
        ];
    }
}
