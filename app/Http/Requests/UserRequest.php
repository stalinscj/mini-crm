<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {   
        $rules = [
            'name'     => 'required|string|max:60',
            'email'    => ['required', 'string', 'email:filter','max:100', Rule::unique('users')->ignore($this->user)],
            'password' => 'required|string|min:8|confirmed',
        ];

        if ($this->isMethod('PUT')) {
            $rules['password'] = 'exclude_unless:update_password,true|' . $rules['password'];
        }

        return $rules;
    }

    /**
     * Get the validated data from the request.
     *
     * @return array
     */
    public function validated()
    {
        $validatedData = parent::validated();

        if (isset($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }

        return $validatedData;
    }
}
