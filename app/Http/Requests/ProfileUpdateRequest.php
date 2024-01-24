<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'string', 'max:255', Rule::unique('users')->ignore(Auth::id())],
            'password' => ['nullable', 'string', 'confirmed', 'min:8'],
            'facebook' => ['required', 'string', 'max:255'],
            'instagram' => ['required', 'string', 'max:255'],
            'twitter' => ['required', 'string', 'max:255'],
            'profile' => ['nullable'],
        ];
    }

    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
        if ($this->password == null) {
            $this->request->remove('password');
        }
        if ($this->profile == null) {
            $this->request->remove('profile');
        }
    }
}
