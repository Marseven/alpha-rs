<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFolderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null; // folders are created by authenticated clients
    }

    public function rules(): array
    {
        return [
            'lastname' => 'required|string|max:255',
            'firstname' => 'nullable|string|max:255',
            'birthday' => 'required|string|max:255',
            'gender' => 'required|string|max:5',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:30',
            'category' => 'required|string|max:255',
            'service_id' => 'required|exists:services,id',
            'country_id' => 'required|exists:countries,id',
            'join_piece' => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240',
        ];
    }
}
