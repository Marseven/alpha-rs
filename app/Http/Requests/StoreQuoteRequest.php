<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuoteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // public quote request form
    }

    public function rules(): array
    {
        $file = 'required|file|mimes:pdf,jpg,jpeg,png|max:10240';

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
            'join_piece_passport' => $file,
            'join_piece_rapport' => $file,
            'join_piece_examen' => $file,
        ];
    }
}
