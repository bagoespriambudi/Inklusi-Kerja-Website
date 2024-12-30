<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJobListingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->role === 'admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'company_id' => ['required', 'exists:companies,id'],
            'job_category_id' => ['required', 'exists:job_categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'requirements' => ['required', 'string'],
            'benefits' => ['required', 'string'],
            'employment_type' => ['required', 'string', 'in:full-time,part-time,contract,internship,freelance'],
            'experience_level' => ['required', 'string', 'in:entry,mid,senior'],
            'location' => ['required', 'string', 'max:255'],
            'salary_range' => ['required', 'string', 'max:255'],
            'deadline' => ['required', 'date', 'after:today'],
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
            'company_id' => 'Perusahaan',
            'job_category_id' => 'Kategori pekerjaan',
            'title' => 'Judul lowongan',
            'description' => 'Deskripsi',
            'requirements' => 'Persyaratan',
            'benefits' => 'Benefit',
            'employment_type' => 'Tipe pekerjaan',
            'experience_level' => 'Level pengalaman',
            'location' => 'Lokasi',
            'salary_range' => 'Kisaran gaji',
            'deadline' => 'Batas akhir',
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
            'employment_type.in' => 'Tipe pekerjaan harus salah satu dari: full-time, part-time, contract, internship, freelance',
            'experience_level.in' => 'Level pengalaman harus salah satu dari: entry, mid, senior',
            'deadline.after' => 'Batas akhir harus setelah hari ini',
        ];
    }
} 