<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
        $rules = [
            'avatar'                => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:2048'],
            'name'                  => ['required', 'string', 'max:255'],
            'email'                 => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user)],
            'phone'                 => ['nullable', 'string', 'max:12', Rule::unique(User::class)->ignore($this->user)],
            'status'                => ['required'],
            'password'              => ['required', 'confirmed', 'string', Password::min(8)],
        ];

        if($this->user){
            $rules['password']      = ['nullable', 'confirmed', 'string', Password::min(8)];
        }

        return $rules;
    }
}
