<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'car_id' => 'required|integer|exists:cars,id',
            'nama_lengkap' => 'required|string|max:255',
            'alamat_lengkap' => 'required|string|max:255',
            'nomer_wa' => 'required|string|max:20', // Adjust the max length as needed
            'tanggal_awal' => 'required', // Ensure the duration is at least 1 day
            'tanggal_akhir' => 'required', // Ensure the duration is at least 1 day
        ];
    }
}
