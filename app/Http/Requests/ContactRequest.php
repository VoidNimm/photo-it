<?php

namespace App\Http\Requests;

use App\Rules\RecaptchaRule;
use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255', 'min:3'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50', 'regex:/^[0-9+\-\s()]+$/'],
            'subject' => ['required', 'string', 'max:255', 'min:5'],
            'message' => ['required', 'string', 'max:2000', 'min:10'],
        ];

        // Validasi reCAPTCHA (skip di local jika belum setup)
        if (!app()->environment('local') || env('RECAPTCHA_SITE_KEY')) {
            $rules['g-recaptcha-response'] = ['required', new RecaptchaRule()];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama lengkap wajib diisi.',
            'name.min' => 'Nama lengkap minimal 3 karakter.',
            'name.max' => 'Nama lengkap maksimal 255 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'phone.regex' => 'Format nomor telepon tidak valid.',
            'subject.required' => 'Subjek wajib diisi.',
            'subject.min' => 'Subjek minimal 5 karakter.',
            'message.required' => 'Pesan wajib diisi.',
            'message.min' => 'Pesan minimal 10 karakter.',
            'message.max' => 'Pesan maksimal 2000 karakter.',
            'g-recaptcha-response.required' => 'Silakan centang reCAPTCHA untuk verifikasi.',
        ];
    }
}