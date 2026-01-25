<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class SignUpRequest extends FormRequest
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
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ];
    }

    public function withValidator($validator) {
        $validator->after(function ($validator) {
            $user = User::where('email', $this->email)->first();

            if ($user) {
                $validator->errors()->add('email', "We couldn't process your request. Please try again or contact support.");
                Log::info('Signup attempt with existing email: ' . $this->email);
            }

            if (strlen($this->password) < 6) {
                $validator->errors()->add('password', 'The password must be at least 6 characters long.');
            }
        });
    }

}
