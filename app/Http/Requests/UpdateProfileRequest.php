<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
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
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->user()->id)],
            'phone_number' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string'],
            'resume' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:2048'], // max 2MB
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:1024'], // max 1MB
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
            'phone_number' => 'Nomor telepon',
            'address' => 'Alamat',
            'resume' => 'Resume',
            'avatar' => 'Foto profil',
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
            'resume.mimes' => 'Resume harus berformat PDF, DOC, atau DOCX',
            'resume.max' => 'Ukuran resume maksimal 2MB',
            'avatar.image' => 'File harus berupa gambar',
            'avatar.mimes' => 'Foto profil harus berformat JPEG, PNG, JPG, atau GIF',
            'avatar.max' => 'Ukuran foto profil maksimal 1MB',
        ];
    }
} 