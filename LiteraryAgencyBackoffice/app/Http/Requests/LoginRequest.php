<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
        return [
            'email' => 'required|email',
            'password' => 'required|string',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            
            $user = User::where('email', $this->email)->first();
            
            if (!$user || !\Hash::check($this->password, $user->password)) {
                $validator->errors()->add('email', 'The provided credentials are incorrect.');
            }

            if (\Hash::needsRehash($user->password)) {
                $validator->errors()->add('password', 'Invalid credentials.');
                return;
            }
        });
    }
}
