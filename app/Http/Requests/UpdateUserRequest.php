<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->user)],
            'password' => ['nullable', 'string', 'min:8'],
            'role' => ['required', 'in:admin,jobseeker'],
            'phone_number' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:1024'],
            'resume' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:2048'],
            'is_premium' => ['boolean'],
            'premium_expires_at' => ['nullable', 'date'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'name' => 'Nama',
            'email' => 'Email',
            'password' => 'Password',
            'role' => 'Role',
            'phone_number' => 'Nomor telepon',
            'address' => 'Alamat',
            'avatar' => 'Foto profil',
            'resume' => 'Resume',
            'is_premium' => 'Status premium',
            'premium_expires_at' => 'Tanggal berakhir premium',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'role.in' => 'Role harus admin atau jobseeker',
            'avatar.image' => 'File harus berupa gambar',
            'avatar.mimes' => 'Foto profil harus berformat JPEG, PNG, JPG, atau GIF',
            'avatar.max' => 'Ukuran foto profil maksimal 1MB',
            'resume.mimes' => 'Resume harus berformat PDF, DOC, atau DOCX',
            'resume.max' => 'Ukuran resume maksimal 2MB',
        ];
    }
} 