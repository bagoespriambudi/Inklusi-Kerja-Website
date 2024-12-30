<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubscriptionPlanRequest extends FormRequest
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
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'duration_in_days' => ['required', 'integer', 'min:1'],
            'features' => ['required', 'array'],
            'features.*' => ['required', 'string'],
            'is_active' => ['boolean'],
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
            'name' => 'Nama paket',
            'description' => 'Deskripsi',
            'price' => 'Harga',
            'duration_in_days' => 'Durasi (hari)',
            'features' => 'Fitur',
            'features.*' => 'Fitur',
            'is_active' => 'Status aktif',
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
            'features.required' => 'Minimal satu fitur harus diisi',
            'features.*.required' => 'Fitur tidak boleh kosong',
            'duration_in_days.min' => 'Durasi minimal 1 hari',
            'price.min' => 'Harga tidak boleh negatif',
        ];
    }
}