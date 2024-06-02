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

    public function rules(): array
    {
        return [
            'name' => 'required:register|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users,email,'.$this->id,
            'password' => 'required|string|confirmed|min:6',
        ];
    }
}
