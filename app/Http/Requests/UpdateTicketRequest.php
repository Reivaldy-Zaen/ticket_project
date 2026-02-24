<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTicketRequest extends FormRequest
{

    public function authorize(): bool
    {

        return true;
    }


    protected function prepareForValidation(): void
    {
        $this->merge([
            'title' => $this->title ? trim($this->title) : null,
            'description' => $this->description ? trim($this->description) : null,
        ]);
    }

    public function rules(): array
    {
        return [
            // Title: wajib, string, 5-255 karakter
            'title' => [
                'required',
                'string',
                'min:5',
                'max:255',
            ],
            
            // Description: wajib, string, minimal 20 karakter
            'description' => [
                'required',
                'string',
                'min:20',
            ],
            
            // Status: wajib untuk update, whitelist values
            'status' => [
                'required',
                'in:open,in_progress,closed',
            ],
            
            // Priority: wajib, whitelist values
            'priority' => [
                'required',
                'in:low,medium,high',
            ],
            
            // Category: opsional
            'category' => [
                'nullable',
                'string',
                'max:100',
            ],
        ];
    }

    /**
     * Get custom error messages.
     */
    public function messages(): array
    {
        return [
            // Title messages
            'title.required' => 'Judul tiket wajib diisi.',
            'title.string' => 'Judul harus berupa teks.',
            'title.min' => 'Judul minimal :min karakter.',
            'title.max' => 'Judul maksimal :max karakter.',
            
            // Description messages
            'description.required' => 'Deskripsi tiket wajib diisi.',
            'description.string' => 'Deskripsi harus berupa teks.',
            'description.min' => 'Deskripsi minimal :min karakter agar permasalahan jelas.',
            
            // Status messages
            'status.required' => 'Status tiket wajib dipilih.',
            'status.in' => 'Status tidak valid. Pilih: Open, In Progress, atau Closed.',
            
            // Priority messages
            'priority.required' => 'Prioritas tiket wajib dipilih.',
            'priority.in' => 'Prioritas tidak valid. Pilih: Low, Medium, atau High.',
            
            // Category messages
            'category.string' => 'Kategori harus berupa teks.',
            'category.max' => 'Kategori maksimal :max karakter.',
        ];
    }

    /**
     * Get custom attribute names.
     */
    public function attributes(): array
    {
        return [
            'title' => 'judul tiket',
            'description' => 'deskripsi',
            'status' => 'status',
            'priority' => 'prioritas',
            'category' => 'kategori',
        ];
    }

    /**
     * Handle passed validation.
     */
    protected function passedValidation(): void
    {
        $this->merge([
            'description' => strip_tags($this->description),
        ]);
    }
}
