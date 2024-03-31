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
            'avatar'   => ['required', 'image', 'mimes:jpeg,jpg,png', 'max:2048'],
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'phone'    => ['nullable', 'string', 'max:11'],
            'password' => ['required', 'confirmed', Password::min(8)],
            'password_confirmation' => ['required', Password::min(8)],
        ];

        if($this->user){
            $rules['avatar']   = ['nullable', 'string', Password::min(8)];
            $rules['password'] = ['nullable'];
            $rules['password_confirmation'] = ['nullable', Password::min(8)];
        }

        return $rules;
    }
}
